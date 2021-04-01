<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Validator;
use App\User;
use App\Userpost;
use App\Role;
use App\TipoRegistro;


class UserController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => [
            'login',
            'register',
            'update',
            'upload',
            'detail',
            'getImage',
            'getUserByTipoRegistro'
            ]]);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register( Request $request){

        //Recoger los datos del usuario por post
        $json = $request->input('json', null); //si no entra nada que sea nulo
        $params = json_decode($json); //separa el json en todos los campos q tenga, EN OBJETOS
        $params_array = json_decode($json, true); // aca lo decodifico en ARRAY

        if(!empty($params)&& !empty($params_array)) {

            //Limpiar datos (usando el prim)
            $params_array = array_map('trim', $params_array);

            //Validar datos
            $validate = \Validator::make($params_array, [
                        'name' => 'required|alpha',
                        'surname' => 'required|alpha',
                        'email' => 'required|email|unique:users',
                        'password' => 'required|min:5',
                        'pais' => '',
                        'idioma' => '',
                        'tiporegistro_id' => '',
                        ]);



            if ($validate->fails()) {
                //La validacion ha fallado
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'mesaje' => 'El usuario no se ha creado',
                    'errors' => $validate->errors()
                ); //obtener datos en Json
            } else {
                //Validacion pasada correctamente

                //cifrar la contraseña
                $pwd = hash('sha256', $params->password);


                //Crear el usuario
                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->pais = $params_array['pais'];
                $user->idioma = $params_array['idioma'];
                $user->tiporegistro_id = $params_array['tiporegistro_id'];
                $user->role = 'ROLE_USER';


                $user->roles()->attach(Role::where('name', 'user')->first());
                //Guardar el usuario
                $user->save();

                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'mesaje' => 'El usuario se ha creado correctamente',
                    'user' => $user
                );
            }

        }else{
            $data = array(
                'status'    => 'error',
                'code'      =>  404,
                'message'   =>  'Los datos enviados no son correctos'
            );

        }

        return response()->json($data, $data['code']); //para devolver el array en json
    }

    public function login( Request $request){

        $jwtAuth = new \JwtAuth();

        /*$email = 'prueba@gmail.com';
        $password = '12345';
        $pwd = hash('sha256', $password);*/

        //var_dump($pwd); die(); 

        //$pwd = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        // recibir datos por post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        //Validar datos
                $validate = \Validator::make($params_array, [
                    'email' => 'required|email',
                    'password' => 'required',
                    'tiporegistro_id' => 'required'
        ]);

        if ($validate->fails()) {
            //La validacion ha fallado
            $signup = array(
                'status' => 'error',
                'code' => 404,
                'mesaje' => 'El usuario no se ha podido identificar',
                'errors' => $validate->errors()
            ); //obtener datos en Json
        } else {
            // cifrar contraseña
            $pwd = hash('sha256', $params->password);

            // devolver token o datos
            $signup = $jwtAuth->signup($params->email, $pwd);

            if(!empty($params->gettoken)){
                $signup = $jwtAuth->signup($params->email, $pwd, true);
            }
        }

        return response()->json($signup, 200);
    }
    


    
    public function update(Request $request, $id){

        // comprobar si el usuario esta autentificado
        $token = $request ->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        //recoger los datos por post
        $json =  $request->input('json', null);
        $params_array =  json_decode($json, true);

        if($checkToken){

            //sacar usuario identificado
            $user = $jwtAuth->checkToken($token, true);

            // validar datos
            $validate = \Validator::make($params_array, [
                'name' => 'required|alpha',
                'surname' => 'required|alpha',
                'email' => 'required|email|unique:users,'.$user->sub
            ]);

            // quitar campos que no quiero actualizar
            unset($params_array['id']);
            unset($params_array['role']);
            unset($params_array['password']);
            unset($params_array['creted_at']);
            unset($params_array['image']);
            unset($params_array['remember_token']);

            //---- AQUI HICE CAMBIOS -----//
            unset($params_array['pagos']);
            unset($params_array['certificados']);
            unset($params_array['conferencias']);
            unset($params_array['documentos']);
            unset($params_array['miembros']);
            unset($params_array['recertconstancias']);
            unset($params_array['recertcertificados']);
            unset($params_array['recertconferencias']);
            unset($params_array['transf_banco']);
            unset($params_array['transf_fecha']);
            unset($params_array['transf_numero']);
            unset($params_array['transf_pdf']);
            //------ HASTA AQUI -----//

            $red_social = $params_array['red_social'];

            response()->json([$red_social]); 

            $user_red=$params_array['user_red'];
            foreach ($params_array['preguntas'] as $redSocial) {
                $red_social=$red_social.';'.$redSocial['red_social'];
                $user_red=$user_red.';'.$redSocial['user_red'];
            }
            unset($params_array['preguntas']);
            unset($params_array['user_red']);
            unset($params_array['red_social']);
        
            // actualizar usuario en bd
            $user_update = User::where('id', $user->sub)
            ->where('user_post_id', $user->sub)
            ->update($params_array);

            $user_update=User::find($user->sub);
            $user_update->red_social= $red_social;
            $user_update->user_red= $user_red;
            $user_update->save();

            // devolver array con resultado
            $data = array(
                'status' => 'success',
                'code' => 200,
                'user' => $user,
                'changes'=> $params_array
            );


        }else{
            $data = array(
                'status' => 'error',
                'code' => 400,
                'mesaje' => 'El usuario no esta identificado',
            );
        }

        return response()->json($data, $data['code']);

    }

    // subir imagen avatar
    public function upload(Request $request) {
              // comprobar si el usuario esta autentificado
              
              $token = $request ->header('Authorization');
              $jwtAuth = new \JwtAuth();
              $checkToken = $jwtAuth->checkToken($token);
           
           
        if($checkToken){
            //sacar usuario identificado
            $user = $jwtAuth->checkToken($token, true);
          
        }
       
        $user_auxiliar=User::find($user->sub);
        

        // recoger datos
        $image = $request->file('file0'); // llama los archivos file0, file1...

        // validar imagen
        $validate = \Validator::make($request->all(),[
            'file0' => 'required|mimes:jpg,jpeg,png,gif' // comprobar el tipo de archivo (imagen)
        ]);

        // guardar imagen


        if($image){

            $image_name = time().$image->getClientOriginalName(); // hace la imagen unica
            \Storage::disk('users')->put($image_name, \File::get($image));
           
            $user_auxiliar->image=$image_name;
            $user_auxiliar->save();

            $data = array(
                'code' => 200,
                'status' => 'success',
                'image' => $image_name
            );

        }else{
            $data = array(
                'code' => 400,
                'status' => 'error',
                'mesaje' => 'Error al subir imagen',
            );

        }

        //return response($data, $data['code'])->header('Content-Type', 'text/plain'); //devuelve el resultado

        return response()->json($data, $data['code']);// devuelve un objeto json
    }

    public function getImage($filename){

        //comprobar si existe la imagen
        $isset = \Storage::disk('users')->exists($filename);
        if($isset){
            $file = \Storage::disk('users')->get($filename);
            return new Response($file, 200);
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'mesaje' => 'Imagen no existe',
            );

            return response()->json($data, $data['code']);
        }

    }

    public function detail($id){

        $user = User::find($id)->load('pagos')
        ->load('certificados')
        ->load('conferencias')
        ->load('userpost')
        ->load('documentos')
        ->load('miembros')
        ->load('recertconstancias')
        ->load('recertconferencias')
        ->load('recertcertificados');

        if(is_object($user)){
            $data = array(
                'status' => 'success',
                'code' => 200,
                'user' => $user,

            );
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'mesaje' => 'El usuario no existe.',
            );
        }

        return response()->json($data, $data['code']);
    }

    public function index(){
        $users = User::all(); // obtiene todo como un get

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'user' => $users
        ], 200);
    }

    public function getUserByTipoRegistro($id){
        $users = User::where('typeRegistroId', $id)->get();

        return response()->json([
            'status' => 'success',
            'posts' => $posts
        ], 200);
    }







}
