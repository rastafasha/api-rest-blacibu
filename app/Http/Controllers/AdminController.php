<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Admin;


class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['except' => [
            'index',
            'register',
            'login',
            'show',
            'update',
            'destroy',
            'getImage',
            'detail'
            ]]);
    }

    public function register( Request $request){


        // comprobar si el admin esta autentificado para el registro interno
        $token = $request ->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkTokenAdmin = $jwtAuth->checkTokenAdmin($token);

        //Recoger los datos del usuario por post
        $json = $request->input('json', null); //si no entra nada que sea nulo
        $params = json_decode($json); //separa el json en todos los campos q tenga, EN OBJETOS
        $params_array = json_decode($json, true); // aca lo decodifico en ARRAY

        if(!empty($params)&& !empty($params_array)) {

            //Limpiar datos (usando el prim)
            $params_array = array_map('trim', $params_array);

            //Validar datos
            $validate = \Validator::make($params_array, [
                        'name' => 'required',
                        'surname' => 'required',
                        'email' => 'required|email|unique:administradores',
                        'password' => 'required|min:5',
                        'pais' => '',
                        'estado' => '',
                        'idioma' => '',
                        'tiporegistro_id' => '',
                        ]);

            if ($validate->fails()) {
                //La validacion ha fallado
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'mesaje' => 'El admin no se ha creado',
                    'errors' => $validate->errors()
                ); //obtener datos en Json
            } else {
                //Validacion pasada correctamente

                //cifrar la contraseña
                $pwd = hash('sha256', $params->password);


                //Crear el usuario
                $admin = new Admin();
                $admin->name = $params_array['name'];
                $admin->surname = $params_array['surname'];
                $admin->email = $params_array['email'];
                $admin->password = $pwd;
                $admin->pais = $params_array['pais'];
                $admin->idioma = $params_array['idioma'];
                $admin->tiporegistro_id = $params_array['tiporegistro_id'];
                $admin->estado = false;
                $admin->role = 'ROLE_ADMIN';

                //Guardar el usuario
                $admin->save();

                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'mesaje' => 'El admin se ha creado correctamente',
                    'admin' => $admin
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

        /*$email = 'mercadocreativo@gmail.com';
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
            $signupAdmin = array(
                'status' => 'error',
                'code' => 404,
                'mesaje' => 'El usuario no se ha podido identificar',
                'errors' => $validate->errors()
            ); //obtener datos en Json
        } else {
            // cifrar contraseña
            $pwd = hash('sha256', $params->password);

            // devolver token o datos
            $signupAdmin = $jwtAuth->signupAdmin($params->email, $pwd);

            if(!empty($params->gettoken)){
                $signupAdmin = $jwtAuth->signupAdmin($params->email, $pwd, true);
            }
        }

        return response()->json($signupAdmin, 200);
    }

    public function update(Request $request, $id){

            // comprobar si el usuario esta autentificado
            $token = $request ->header('Authorization');
            $jwtAuth = new \JwtAuth();
            $checkTokenAdmin = $jwtAuth->checkTokenAdmin($token);

        //recoger los datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if($checkTokenAdmin){

            //sacar usuario identificado
            $admin = $jwtAuth->checkTokenAdmin($token, true);

            // validar datos
            $validate = \Validator::make($params_array, [
                'name'=> 'required',
                'surname'=> 'required',
                'email' => 'required|email|unique:administradores,'.$admin->sub,
                'tiporegistro_id' => 'required'
            ]);

            // quitar campos que no quiero actualizar
            unset($params_array['id']);
            unset($params_array['role']);
            unset($params_array['tiporegistro_id']);
            unset($params_array['password']);
            unset($params_array['creted_at']);
            unset($params_array['remember_token']);

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
            $admin_update = Admin::where('id', $admin->sub)->update($params_array);

            $admin_update=Admin::find($admin->sub);
            $admin_update->red_social= $red_social;
            $admin_update->user_red= $user_red;
            $admin_update->save();

            // devolver array con resultado
            $data = array(
                'status' => 'success',
                'code' => 200,
                'admin' => $admin,
                'changes'=> $params_array
            );

            //echo "<h1>Login Correcto</h1>";


        }else{
            $data = array(
                'status' => 'error',
                'code' => 400,
                'mesaje' => 'El admin no esta identificado',
            );
            //echo "<h1>Login Inconrrecto</h1>";
        }

        //die();

        return response()->json($data, $data['code']);
    }



    // subir imagen avatar
    public function upload(Request $request) {

        // comprobar si el usuario esta autentificado
              
        $token = $request ->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkTokenAdmin = $jwtAuth->checkTokenAdmin($token);

        if($checkToken){
            //sacar usuario identificado
            $admin = $jwtAuth->checkToken($token, true);
          
        }

        $admin_auxiliar=Admin::find($admin->sub);

        // recoger datos
        $image = $request->file('file0'); // llama los archivos file0, file1...

        // validar imagen
        $validate = \Validator::make($request->all(),[
            'file0' => 'required|mimes:jpg,jpeg,png,gif' // comprobar el tipo de archivo (imagen)
        ]);

        // guardar imagen


        if($image){

            $image_name = time().$image->getClientOriginalName(); // hace la imagen unica
            \Storage::disk('admin')->put($image_name, \File::get($image));

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

       // return response($data, $data['code'])->header('Content-Type', 'text/plain'); //devuelve el resultado

        return response()->json($data, $data['code']);// devuelve un objeto json
    }

    public function getImage($filename){

        //comprobar si existe la imagen
        $isset = \Storage::disk('admin')->exists($filename);
        if($isset){
            $file = \Storage::disk('admin')->get($filename);
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

        $admin = Admin::find($id);

        if(is_object($admin)){
            $data = array(
                'status' => 'success',
                'code' => 200,
                'admin' => $admin,

            );
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'mesaje' => 'El admin no existe.',
            );
        }

        return response()->json($data, $data['code']);
    }

    public function index(){
        $admins = Admin::all(); // obtiene todo como un get

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'admin' => $admins
        ], 200);
    }

    public function getAdminByTipoRegistro($id){
        $admins = Admin::where('typeRegistroId', $id)->get();

        return response()->json([
            'status' => 'success',
            'admins' => $admins
        ], 200);
    }









}
