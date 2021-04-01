<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Reponse;

use Validator;
use App\Certificado;
use App\User;

use App\Helpers\JwtAuth;

class CertificadoController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except' => [
            'index',
            'show',
            'upload',
            'update',
            'getFilePdf',
            'getCertificadoByUser'
            ]]);
    }

    public function index(){
        $certificados = Certificado::all()->load('tiporegistros')
        ->load('user');

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'certificados' => $certificados
        ], 200);
    }




    public function show($id){
        $certificado = Certificado::find($id)->load('certificado')
                                ->load('user');


        if(is_object($certificado)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'certificado' => $certificado
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'El certificado no existe'
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
                'transf_banco' => 'required',
                'transf_numero' => 'required',
                'transf_numero' => 'required',
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
                $certificado = new Certificado();
                $certificado->user_id = $user->sub;
                $certificado->tiporegistro_id = $params->tiporegistro_id;
                $certificado->cert_asist_avalados_nombre = $params->cert_asist_avalados_nombre;
                $certificado->cert_asist_avalados_ano = $params->cert_asist_avalados_ano;
                $certificado->cert_asist_avalados_otrasinst = $params->cert_asist_avalados_otrasinst;
                $certificado->cert_asist_avalados_horas = $params->cert_asist_avalados_horas;
                $certificado->cert_asist_avalados_status_id = $params->cert_asist_avalados_status_id;
                $certificado->cert_asist_no_avalados_nombre = $params->cert_asist_no_avalados_nombre;
                $certificado->cert_asist_no_avalados_ano = $params->cert_asist_no_avalados_ano;
                $certificado->cert_asist_no_avalados_otrasinst = $params->cert_asist_no_avalados_otrasinst;
                $certificado->cert_asist_no_avalados_horas = $params->cert_asist_no_avalados_horas;
                $certificado->cert_asist_no_avalados_status_id = $params->cert_asist_no_avalados_status_id;
                $certificado->cert_o_diploma_academico_nombre = $params->cert_o_diploma_academico_nombre;
                $certificado->cert_o_diploma_academico_cargo = $params->cert_o_diploma_academico_cargo;
                $certificado->cert_o_diploma_academico_tiempo = $params->cert_o_diploma_academico_tiempo;
                $certificado->cert_o_diploma_academico_otrasinst = $params->cert_o_diploma_academico_otrasinst;
                $certificado->cert_o_diploma_academico_pdf = $params->cert_o_diploma_academico_pdf;
                $certificado->cert_o_diploma_academico_status_id = $params->cert_o_diploma_academico_status_id;
                $certificado->cert_o_diploma_asistencial_cargo = $params->cert_o_diploma_asistencial_cargo;
                $certificado->cert_o_diploma_asistencial_tiempo = $params->cert_o_diploma_asistencial_tiempo;
                $certificado->cert_o_diploma_asistencial_otrasinst = $params->cert_o_diploma_asistencial_otrasinst;
                $certificado->cert_o_diploma_asistencial_pdf = $params->cert_o_diploma_asistencial_pdf;
                $certificado->cert_o_diploma_asistencial_status_id = $params->cert_o_diploma_asistencial_status_id;
                $certificado->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'certificado' => $certificado
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

    public function update($id, Request $request){
        // recoger los datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        

       

        /*if($checkToken){
            //sacar usuario identificado
            $user = $jwtAuth->checkToken($token, true);
          
        }*/

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
        }else{
 
            $filepdf_name = time().$filepdf->getClientOriginalName();
           \Storage::disk('certificados')->put($filepdf_name, \File::get($filepdf));

           return response($filepdf_name);
           
               //obtener el  documento para almacenar la direccion del pdf
               $user_auxiliar=User::find($user->sub);
               $certificado_auxiliar=Certificado::where('user_post_id', $user->sub)->first();
               
               //response()->json($pago_auxiliar,'estoy en pagos');
               //almaceno la direccion del pago
               switch ($request->header('document')) {
                   case 1:
                       $certificado_auxiliar->cert_asist_avalados_pdf = $filepdf_name;
                       $certificado_auxiliar->cert_asist_avalados_pdf_status_id = 1;
                       break;
                   case 2:
                       $certificado_auxiliar->cert_asist_no_avalados_pdf = $filepdf_name;
                       $certificado_auxiliar->cert_asist_no_avalados_pdf_status_id = 1;
                       break;
                   case 3:
                       $certificado_auxiliar->cert_o_diploma_academico_pdf = $filepdf_name;
                       $certificado_auxiliar->cert_o_diploma_academico_pdf_status_id = 1;
                       break;
                   case 4:
                       $certificado_auxiliar->cert_o_diploma_asistencial_pdf = $filepdf_name;
                       $certificado_auxiliar->cert_o_diploma_asistencial_pdf_status_id = 1;
                       break;
               }
               $certificado_auxiliar->save();
            

               
            $data = [
                'code' => 200,
                'status' => 'success',
                'selector' => $request->header('certificado'),
                'filepdf' => $filepdf_name
              
            ];

        }

        if(!empty($params_array)){
            
            

            // campos duplicables o dinamicos
            $cert_asist_avalados_nombre = $params_array['cert_asist_avalados_nombre'];
            $cert_asist_avalados_ano=$params_array['cert_asist_avalados_ano'];
            $cert_asist_avalados_otrasinst=$params_array['cert_asist_avalados_otrasinst'];
            $cert_asist_avalados_horas=$params_array['cert_asist_avalados_horas'];
            $cert_asist_avalados_pdf=$params_array['cert_asist_avalados_pdf'];
            
            $cert_asist_no_avalados_nombre = $params_array['cert_asist_no_avalados_nombre'];
            $cert_asist_no_avalados_ano=$params_array['cert_asist_no_avalados_ano'];
            $cert_asist_no_avalados_otrasinst=$params_array['cert_asist_no_avalados_otrasinst'];
            $cert_asist_no_avalados_horas=$params_array['cert_asist_no_avalados_horas'];
            $cert_asist_no_avalados_pdf=$params_array['cert_asist_no_avalados_pdf'];
            
            $cert_o_diploma_academico_nombre=$params_array['cert_o_diploma_academico_nombre'];
            $cert_o_diploma_academico_cargo=$params_array['cert_o_diploma_academico_cargo'];
            $cert_o_diploma_academico_tiempo=$params_array['cert_o_diploma_academico_tiempo'];
            $cert_o_diploma_academico_otrasinst=$params_array['cert_o_diploma_academico_otrasinst'];
            $cert_o_diploma_academico_pdf=$params_array['cert_o_diploma_academico_pdf'];
            
            $cert_o_diploma_asistencial_cargo=$params_array['cert_o_diploma_asistencial_cargo'];
            $cert_o_diploma_asistencial_tiempo=$params_array['cert_o_diploma_asistencial_tiempo'];
            $cert_o_diploma_asistencial_otrasinst=$params_array['cert_o_diploma_asistencial_otrasinst'];
            $cert_o_diploma_asistencial_pdf=$params_array['cert_o_diploma_asistencial_pdf'];
            
            
            foreach ($params_array['preguntas'] as $certNombres) {
                $cert_asist_avalados_nombre=$cert_asist_avalados_nombre.';'.$certNombres['cert_asist_avalados_nombre'];
                $cert_asist_avalados_ano=$cert_asist_avalados_ano.';'.$certNombres['cert_asist_avalados_ano'];
                $cert_asist_avalados_otrasinst=$cert_asist_avalados_otrasinst.';'.$certNombres['cert_asist_avalados_otrasinst'];
                $cert_asist_avalados_horas=$cert_asist_avalados_horas.';'.$certNombres['cert_asist_avalados_horas'];
                $cert_asist_avalados_pdf=$cert_asist_avalados_pdf.';'.$certNombres['cert_asist_avalados_pdf'];
            }
            
            foreach ($params_array['preguntas1'] as $certAsistnoNombre) {
                $cert_asist_no_avalados_nombre=$cert_asist_no_avalados_nombre.';'.$certAsistnoNombre['cert_asist_no_avalados_nombre'];
                $cert_asist_no_avalados_ano=$cert_asist_no_avalados_ano.';'.$certAsistnoNombre['cert_asist_no_avalados_ano'];
                $cert_asist_no_avalados_otrasinst=$cert_asist_no_avalados_otrasinst.';'.$certAsistnoNombre['cert_asist_no_avalados_otrasinst'];
                $cert_asist_no_avalados_horas=$cert_asist_no_avalados_horas.';'.$certAsistnoNombre['cert_asist_no_avalados_horas'];
                $cert_asist_no_avalados_pdf=$cert_asist_no_avalados_pdf.';'.$certAsistnoNombre['cert_asist_no_avalados_pdf'];
            }

            // quitar campos que no quiero actualizar
            unset($params_array['id']);
            unset($params_array['role']);
            unset($params_array['password']);
            unset($params_array['creted_at']);
            unset($params_array['tiporegistro_id']);
            unset($params_array['remember_token']);
            unset($params_array['preguntas']);
            unset($params_array['cert_asist_avalados_nombre']);
            unset($params_array['cert_asist_avalados_otrasinst']);
            unset($params_array['cert_asist_avalados_horas']);
            unset($params_array['cert_asist_avalados_pdf']);
            unset($params_array['cert_asist_no_avalados_nombre']);
            unset($params_array['cert_asist_no_avalados_otrasinst']);
            unset($params_array['cert_asist_no_avalados_horas']);
            unset($params_array['cert_asist_no_avalados_pdf']);
        

             // conseguir el usuario identificado
            $jwtAuth = new JwtAuth();
            $token = $request->header('Authorization', null);
            $user = $jwtAuth->checkToken($token, true);
        

            //buscar el registro
            $certificado = Certificado::where('id', $id)
                        ->where('user_id', $user->sub)
                        ->where('user_post_id', $user->sub)
                        ->where('tiporegistro_id', $user->tiporegistro_id)
                        ->where('user_id', $admin->sub)
                        ->updateOrCreate($params_array);

            if(!empty($certificado) && is_object($certificado)){

                //Actualizar el registro en concreto
                $certificado->update($params_array);

                // devolver respuesta
                $data = array(
                    'code' => 200,
                    'status' => 'success',
                    'certificado' => $certificado,
                    'changes' => $params_array
                );
            }

            // actualizar registro
            $certificado = Certificado::where('id', $id)
                        ->where('user_id', $user->sub)
                        ->where('user_post_id', $user->sub)
                        ->where('tiporegistro_id', $user->tiporegistro_id)
                        ->updateOrCreate($params_array);

            }


        return response()->json($data, $data['code']);

    

    }
/*

public function update($id, Request $request){
    // recoger los datos por post
    $json = $request->input('json', null);
    $params_array = json_decode($json, true);

    // datos para devolver
    $data = array(
        'code' => 200,
        'status' => 'success',
        'pago' => $params_array
    );

    if(!empty($params_array)){
        // validar los datos
        $validate = \Validator::make($params_array, [
            'transf_banco' => 'required',
            'transf_numero' => 'required'
        ]);

        if($validate->fails()){

            $data['errors'] = $validate->errors();

            return response()->json($data, $data['code']);
        }

        
        // eliminar lo que no queremos actualizar
        unset($params_array['id']);
        unset($params_array['user_id']);
        unset($params_array['tiporegistro_id']);
        unset($params_array['created_at']);
        unset($params_array['user']);

        // conseguir el usuario identificado
        //$user = $this->getIdentity($request);
        // conseguir el usuario identificado
        $jwtAuth = new JwtAuth();
        $token = $request->header('Authorization', null);
        $user = $jwtAuth->checkToken($token, true);

        //buscar el registro
        $certificado = Certificado::where('id', $id)
                    ->where('user_id', $user->sub)
                    ->where('tiporegistro_id', $user->tiporegistro_id)
                    ->where('user_id', $admin->sub)
                    ->updateOrCreate($params_array);

        if(!empty($certificado) && is_object($certificado)){

            //Actualizar el registro en concreto
            $certificado->update($params_array);

            // devolver respuesta
            $data = array(
                'code' => 200,
                'status' => 'success',
                'certificado' => $certificado,
                'changes' => $params_array
            );
        }


        // actualizar registro
        $certificado = Certificado::where('id', $id)
                    ->where('user_id', $user->sub)
                    ->where('tiporegistro_id', $user->tiporegistro_id)
                    ->updateOrCreate($params_array);

    }


    return response()->json($data, $data['code']);
}

*/
    public function destroy($id, Request $request){

        // conseguir el usuario identificado
        $user = $this->getIdentity($request);


        // conseguir el post
        $certificado =  Certificado::where('id', $id)
                        ->where('user_id', $user->sub)
                        ->where('user_post_id', $user->sub)
                        ->where('tiporegistro_id', $user->tiporegistro_id)
                        ->first();

        if(!empty($certificado)){

            // borrar
            $certificado->delete();
            // devolver respuesta
            $data = [
                'code' => 200,
                'status' => 'success',
                'certificado' => $certificado
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

        // comprobar si el usuario esta autentificado
              
        $token = $request ->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        if($checkToken){
            //sacar usuario identificado
            $user = $jwtAuth->checkToken($token, true);
          
        }
       
        $certificado_auxiliar=User::find($user->sub);


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
       }else{
           $filepdf_name = $time().$filepdf->getClientOriginalName();

           \Storage::disk('certificados')->put($filepdf_name, \File::get($filepdf));

           $certificado_auxiliar=Certificado::where('user_id', $user->sub)->first();
           
           $certificado_auxiliar->cert_asist_avalados_pdf=$filepdf_name;
           $certificado_auxiliar->cert_asist_no_avalados_pdf=$filepdf_name;
           $certificado_auxiliar->save();

           
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
        $isset = \Storage::disk('certificados')->exists($filename);

        if($isset){
            //conseguir la imagen
            $file = \Storage::disk('certificados')->get($filename);
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


    public function getCertificadoByUser($id){
        $certificados = Certificado::where('user_id', $id)->get()->load('user');

        return response()->json([
            'status' => 'success',
            'certificados' => $certificados
        ], 200);
    }
}
