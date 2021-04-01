<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Reponse;

use App\Documento;
use App\User;
use App\Helpers\JwtAuth;


class DocumentoController extends Controller
{
    public function __construct(){
        $this->middleware('api.auth',['except' => [
            'index',
            'show',
            'getDocument',
            'upload',
            'update',
            'getDocumentosByUser'
            ]]);
    }



    public function index(){
        $documentos = Documento::all()->Load('tiporegistros');

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'documentos' => $documentos
        ], 200);
    }

    public function show($id){
        $documento = Documentos::find($id)->load('documento')
                                ->load('user');


        if(is_object($documento)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'documento' => $documento
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La entrada no existe'
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
                    'message' => 'No se ha guardado el documento, faltan datos'
                ];
            }else{
                // guardar el post
                $documento = new Documento();
                $documento->user_id = $user->sub;
                $documento->tiporegistro_id = $params->tiporegistro_id;
                $documento->pdf_titulo_odontologo = $params->pdf_titulo_odontologo;
                $documento->pdf_titulo_odontologo_status_id = $params->pdf_titulo_odontologo_status_id;
                $documento->pdf_matricula_odontologo = $params->pdf_matricula_odontologo;
                $documento->pdf_matricula_odontologo_status_id = $params->pdf_matricula_odontologo_status_id;
                $documento->pdf_titulo_espec_bucomax = $params->pdf_titulo_espec_bucomax;
                $documento->pdf_titulo_espec_bucomax_status_id = $params->pdf_titulo_espec_bucomax_status_id;
                $documento->pdf_matricula_bucomax = $params->pdf_matricula_bucomax;
                $documento->pdf_matricula_bucomax_status_id = $params->pdf_matricula_bucomax_status_id;
                $documento->pdf_residencia_especializacion = $params->pdf_residencia_especializacion;
                $documento->pdf_residencia_especializacion_status_id = $params->pdf_residencia_especializacion_status_id;
                $documento->pdf_constancia_miembro = $params->pdf_constancia_miembro;
                $documento->pdf_constancia_miembro_status_id = $params->pdf_constancia_miembro_status_id;
                $documento->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'documento' => $documento
                ];

            }


        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No se ha guardado el documento, faltan datos'
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
         //return response()->json($request);   
         else {
 
             $filepdf_name = time().$filepdf->getClientOriginalName();
            \Storage::disk('documentos')->put($filepdf_name, \File::get($filepdf));
 
            
                //obtener el  documento para almacenar la direccion del pdf
                $user_auxiliar=User::find($user->sub);
                $documento_auxiliar=Documento::where('user_id', $user->sub)->first();
                
                //response()->json($documento_auxiliar,'estoy en documentos');
                //almaceno la direccion del pago
                switch ($request->header('document')) {
                    case 1:
                        $documento_auxiliar->pdf_titulo_odontologo = $filepdf_name;
                        $documento_auxiliar->pdf_titulo_odontologo_status_id = 1;
                        break;
                    case 2:
                        $documento_auxiliar->pdf_matricula_odontologo = $filepdf_name;
                        $documento_auxiliar->pdf_matricula_odontologo_status_id = 1;
                        break;
                    case 3:
                        $documento_auxiliar->pdf_titulo_espec_bucomax = $filepdf_name;
                        $documento_auxiliar->pdf_titulo_espec_bucomax_status_id = 1;
                        break;
                    case 4:
                        $documento_auxiliar->pdf_matricula_bucomax = $filepdf_name;
                        $documento_auxiliar->pdf_matricula_bucomax_status_id = 1;
                        break;
                    case 5:
                        $documento_auxiliar->pdf_residencia_especializacion = $filepdf_name;
                        $documento_auxiliar->pdf_residencia_especializacion_status_id = 1;
                        break;
                    case 6:
                        $documento_auxiliar->pdf_constancia_miembro = $filepdf_name;
                        $documento_auxiliar->pdf_constancia_miembro_status_id = 1;
                        break;
                }
                $documento_auxiliar->save();
             
 
                
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
        $documento =  Documento::where('id', $id)
                        ->where('user_id', $user->sub)
                        ->where('user_post_id', $user->sub)
                        ->where('tiporegistro_id', $user->tiporegistro_id)
                        ->first();

        if(!empty($documento)){

            // borrar
            $documento->delete();
            // devolver respuesta
            $data = [
                'code' => 200,
                'status' => 'success',
                'documento' => $documento
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'el post no existe'
            ];
        }

        return response()->json($data, $data['code']);
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

           \Storage::disk('documentos')->put($file_name, \File::get($file));

           $data = [
               'code' => 200,
               'status' => 'success',
               'file' => $file_name
           ];

       }
       // devolver datos
       return response()->json($data, $data['code']);
      }



      private function getIdentity($request){
        $jwtAuth = new JwtAuth();
        $token = $request->header('Authorization', null);
        $user = $jwtAuth->checkToken($token, true);

        return $users;
    }

    public function getDocument($filename){
        // comprobar si existe
        $isset = \Storage::disk('documentos')->exists($filename);

        if($isset){
            //conseguir la imagen
            $file = \Storage::disk('documentos')->get($filename);
            // devolve la imagen
            return new Response($file, 200);
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'El archivo no existe.'
            ];
        }
        // mostrar error
        return response()->json($data, $data['code']);
    }


    public function getDocumentosByUser($id){
        $documentos = Documento::where('user_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'documentos' => $documentos
        ], 200);
    }
}
