<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Reponse;

use App\RecertConstancia;
use App\User;
use App\Helpers\JwtAuth;

class RecertConstanciaController extends Controller
{
    public function __construct(){
        $this->middleware('api.auth',['except' => [
            'index',
            'show',
            'upload',
            'update',
            'getFilePdf',
            'getRecertConstanciaByUser'
            ]]);
    }

    public function index(){
        $recertconstancias = RecertConstancia::all()->Load('tiporegistros');

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'recertconstancias' => $recertconstancias
        ], 200);
    }

    public function show($id){
        $recertconstancia = RecertConstancia::find($id)->load('recertconstancias')
                                ->load('user');


        if(is_object($recertconstancia)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'recertconstancia' => $recertconstancia
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La constancia no existe'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function store(Request $request){
        //  Recoger datos por post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        if(!empty($params_array)){
            // conseguir el usuario identificado
            //$user = $this->getIdentity($request);
            // comprobar si el usuario esta autentificado
            $token = $request ->header('Authorization');
            $jwtAuth = new \JwtAuth();
            $checkToken = $jwtAuth->checkToken($token);

            // Validar los datos
            $validate = \Validator::make($params_array, [
                'user_id' => 'required',
                'tiporegistro_id' => 'required',
                'email' => 'required|email|unique:users,email,'.$user->sub
            ]);

            if($validate->fails()){
                $data = [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'No se ha guardado la información, faltan datos'
                ];
            }else{
                // guardar el post
                $recertconstancia = new RecertConstancia();
                $recertconstancia->user_id = $user->sub;
                $recertconstancia->const_miembro_activo_pdf = $params->const_miembro_activo_pdf;
                $recertconstancia->const_miembro_activo_status_id = $params->const_miembro_activo_status_id;
                $recertconstancia->curriculum_pdf = $params->curriculum_pdf;
                $recertconstancia->curriculum_status_id = $params->curriculum_status_id;
                $recertconstancia->const_practica_privada_status_id = $params->const_practica_privada_status_id;
                $recertconstancia->const_anos = $params->const_anos;
                $recertconstancia->distinciones_premios_pdf = $params->distinciones_premios_pdf;
                $recertconstancia->distinciones_premios_status_id = $params->distinciones_premios_status_id;
                $recertconstancia->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'recertconstancia' => $recertconstancia
                ];

            }


        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No se ha guardado el certificado, faltan datos'
            ];
        }


        // devolver respuesta
        return response()->json($data, $data['code']);
    }

    public function update(Request $request){
        // recoger los datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        $token = $request ->header('Authorization');
         $jwtAuth = new \JwtAuth();
         $checkToken = $jwtAuth->checkToken($token);

         if($checkToken){
            //sacar usuario identificado
            $user = $jwtAuth->checkToken($token, true);
          
        }

        // recoger la imagen de la peticion
        $filepdf = $request->file('file0');
        // validar la imagen
        $validate = \Validator::make($request->all(),[
            'file0' => 'required|mimes:pdf'
        ]);
        //guardar la imagen en un disco
        if(!$filepdf || $validate->fails()){
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error al subir el archivo'
            ];
        }
        else {
 
            $filepdf_name = time().$filepdf->getClientOriginalName();
           \Storage::disk('recertconstancias')->put($filepdf_name, \File::get($filepdf));

           
               //obtener el  documento para almacenar la direccion del pdf
               $user_auxiliar=User::find($user->sub);
               $recertconstancia_auxiliar=RecertConstancia::where('user_id', $user->sub)->first();
               
               //response()->json($pago_auxiliar,'estoy en pagos');
               //almaceno la direccion del pago
               switch ($request->header('document')) {
                   case 1:
                       $recertconstancia_auxiliar->const_miembro_activo_pdf = $filepdf_name;
                       $recertconstancia_auxiliar->const_miembro_activo_status_id = 1;
                       break;
                   case 2:
                       $recertconstancia_auxiliar->curriculum_pdf = $filepdf_name;
                       $recertconstancia_auxiliar->curriculum_status_id = 1;
                       break;
                   case 3:
                       $recertconstancia_auxiliar->const_practica_privada_pdf = $filepdf_name;
                       $recertconstancia_auxiliar->const_practica_privada_status_id = 1;
                       break;
                   case 4:
                       $recertconstancia_auxiliar->distinciones_premios_pdf = $filepdf_name;
                       $recertconstancia_auxiliar->distinciones_premios_status_id = 1;
                       break;
               }
               $recertconstancia_auxiliar->save();
            

               
            $data = [
                'code' => 200,
                'status' => 'success',
                'selector' => $request->header('document'),
                'filepdf' => $filepdf_name
              
            ];

        }


       return response()->json($data, $data['code']);
    }

    public function destroy($id, Request $request){

        // conseguir el usuario identificado
        $user = $this->getIdentity($request);


        // conseguir el post
        $recertconstancia =  RecertConstancia::where('id', $id)
                        ->where('user_id', $user->sub)
                        ->first();

        if(!empty($recertconstancia)){

            // borrar
            $recertconstancia->delete();
            // devolver respuesta
            $data = [
                'code' => 200,
                'status' => 'success',
                'recertconstancia' => $recertconstancia
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'el certificado no existe'
            ];
        }

        return response()->json($data, $data['code']);
    }

    private function getIdentity($request){
        $jwtAuth = new JwtAuth();
        $token = $request->header('Authorization', null);
        $user = $jwtAuth->checkToken($token, true);

        return $users;
    }

    public function upload(Request $request){
        // recoger la imagen de la peticion
       $file = $request->file('file0');
       // validar la imagen
       $validate = \Validator::make($request->all(),[
           'file0' => 'required|mimes:pdf'
       ]);
       //guardar la imagen en un disco
       if(!$file || $validate->fails()){
           $data = [
               'code' => 400,
               'status' => 'error',
               'message' => 'Error al subir el archivo'
           ];
       }else{
           $file_name = $time().$file->getClientOriginalName();

           \Storage::disk('recertconstancias')->put($file_name, \File::get($file));

           $data = [
               'code' => 200,
               'status' => 'success',
               'file' => $file_name
           ];

       }
       // devolver datos
       return response()->json($data, $data['code']);
    }

    public function getFilePdf($filename){
        // comprobar si existe
        $isset = \Storage::disk('recertconstancias')->exists($filename);

        if($isset){
            //conseguir la imagen
            $file = \Storage::disk('recertconstancias')->get($filename);
            // devolve la imagen
            return new Response($file, 200);
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La imagen no existe.'
            ];
        }
        // mostrar error
        return response()->json($data, $data['code']);
    }

    /*public function getPostsByCategory($id){
        $posts = Post::where('category_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'posts' => $posts
        ], 200);
    }*/

    public function getRecertConstanciaByUser($id){
        $recertconstancias = RecertConstancia::where('user_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'recertconstancias' => $recertconstancias
        ], 200);
    }
}
