<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Reponse;

use App\RecertCertificado;
use App\Helpers\JwtAuth;

class RecertCertificadoController extends Controller
{
    public function __construct(){
        $this->middleware('api.auth',['except' => [
            'index',
            'show',
            'update',
            'upload',
            'getFilePdf',
            'getRecertificadoByUser'
            ]]);
    }

    public function index(){
        $recertcertificados = RecertCertificado::all()->Load('tiporegistros')
        ->load('user');

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'recertcertificados' => $recertcertificados
        ], 200);
    }

    public function show($id){
        $recertcertificado = RecertCertificado::find($id)->load('recertcertificados')
                                ->load('user');


        if(is_object($recertcertificado)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'recertcertificados' => $recertcertificado
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
                'cert_act_academicas_y_asistenciales_nombre' => 'required',
                'cert_act_academicas_y_asistenciales_cargo' => 'required'
            ]);

            if($validate->fails()){
                $data = [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'No se ha guardado la información, faltan datos'
                ];
            }else{
                // guardar el post
                $recertcertificado = new RecertCertificado();
                $recertcertificado->user_id = $user->sub;
                $recertcertificado->tiporegistro_id = $params->tiporegistro_id;
                $recertcertificado->cert_act_academicas_y_asistenciales_nombre = $params->cert_act_academicas_y_asistenciales_nombre;
                $recertcertificado->cert_act_academicas_y_asistenciales_cargo = $params->cert_act_academicas_y_asistenciales_cargo;
                $recertcertificado->cert_act_academicas_y_asistenciales_tiempo = $params->cert_act_academicas_y_asistenciales_tiempo;
                $recertcertificado->cert_act_academicas_y_asistenciales_institucion = $params->cert_act_academicas_y_asistenciales_institucion;
                $recertcertificado->cert_act_academicas_y_asistenciales_pdf = $params->cert_act_academicas_y_asistenciales_pdf;
                $recertcertificado->cert_act_academicas_y_asistenciales_status_id = $params->cert_act_academicas_y_asistenciales_status_id;
                $recertcertificado->trab_esp_y_art_cientificos_nombre = $params->trab_esp_y_art_cientificos_nombre;
                $recertcertificado->trab_esp_y_art_cientificos_ano = $params->trab_esp_y_art_cientificos_ano;
                $recertcertificado->trab_esp_y_art_cientificos_revista = $params->trab_esp_y_art_cientificos_revista;
                $recertcertificado->trab_esp_y_art_cientificos_institucion = $params->trab_esp_y_art_cientificos_institucion;
                $recertcertificado->trab_esp_y_art_cientificos_encalidad = $params->trab_esp_y_art_cientificos_encalidad;
                $recertcertificado->trab_esp_y_art_cientificos_pdf = $params->trab_esp_y_art_cientificos_pdf;
                $recertcertificado->trab_esp_y_art_cientificos_status_id = $params->trab_esp_y_art_cientificos_status_id;
                $recertcertificado->act_editor_revisor_pub_cient_nombre = $params->act_editor_revisor_pub_cient_nombre;
                $recertcertificado->act_editor_revisor_pub_cient_ano = $params->act_editor_revisor_pub_cient_ano;
                $recertcertificado->act_editor_revisor_pub_cient_revista = $params->act_editor_revisor_pub_cient_revista;
                $recertcertificado->act_editor_revisor_pub_cient_pdf = $params->act_editor_revisor_pub_cient_pdf;
                $recertcertificado->act_editor_revisor_pub_cient_status_id = $params->act_editor_revisor_pub_cient_status_id;
                $recertcertificado->cert_asist_simposio_de_especialidad_nombre = $params->cert_asist_simposio_de_especialidad_nombre;
                $recertcertificado->cert_asist_simposio_de_especialidad_modalidad = $params->cert_asist_simposio_de_especialidad_modalidad;
                $recertcertificado->cert_asist_simposio_de_especialidad_ano = $params->cert_asist_simposio_de_especialidad_ano;
                $recertcertificado->cert_asist_simposio_de_especialidad_institucion = $params->cert_asist_simposio_de_especialidad_institucion;
                $recertcertificado->cert_asist_simposio_de_especialidad_horas = $params->cert_asist_simposio_de_especialidad_horas;
                $recertcertificado->cert_asist_simposio_de_especialidad_encalidade = $params->cert_asist_simposio_de_especialidad_encalidade;
                $recertcertificado->cert_asist_simposio_de_especialidad_pdf = $params->cert_asist_simposio_de_especialidad_pdf;
                $recertcertificado->cert_asist_simposio_de_especialidad_status_id = $params->cert_asist_simposio_de_especialidad_status_id;
                $recertcertificado->cert_asist_simposio_no_especialidad_nombre = $params->cert_asist_simposio_no_especialidad_nombre;
                $recertcertificado->cert_asist_simposio_no_especialidad_modalidad = $params->cert_asist_simposio_no_especialidad_modalidad;
                $recertcertificado->cert_asist_simposio_no_especialidad_ano = $params->cert_asist_simposio_no_especialidad_ano;
                $recertcertificado->cert_asist_simposio_no_especialidad_institucion = $params->cert_asist_simposio_no_especialidad_institucion;
                $recertcertificado->cert_asist_simposio_no_especialidad_horas = $params->cert_asist_simposio_no_especialidad_horas;
                $recertcertificado->cert_asist_simposio_no_especialidad_encalidade = $params->cert_asist_simposio_no_especialidad_encalidade;
                $recertcertificado->cert_asist_simposio_no_especialidad_pdf = $params->cert_asist_simposio_no_especialidad_pdf;
                $recertcertificado->cert_asist_simposio_no_especialidad_status_id = $params->cert_asist_simposio_no_especialidad_status_id;
                $recertcertificado->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'recertcertificado' => $recertcertificado
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

        // datos para devolver
        $data = array(
            'code' => 200,
            'status' => 'success',
            'recertcertificado' => $params_array
        );

        if(!empty($params_array)){
            // validar los datos
        $validate = \Validator::make($params_array, [
            'cert_act_academicas_y_asistenciales_nombre' => '',
        ]);

        if($validate->fails()){

            $data['errors'] = $validate->errors();

            return response()->json($data, $data['code']);
        }
        // eliminar lo que no queremos actualizar
        unset($params_array['id']);
        unset($params_array['user_id']);
        unset($params_array['created_at']);
        unset($params_array['tiporegistro_id']);
        unset($params_array['user']);

        // conseguir el usuario identificado
        //$user = $this->getIdentity($request);
        // conseguir el usuario identificado
        $jwtAuth = new JwtAuth();
        $token = $request->header('Authorization', null);
        $user = $jwtAuth->checkToken($token, true);

        //buscar el registro
        $recertcertificado = RecertCertificado::where('id', $id)
                    ->where('user_id', $user->sub)
                    ->where('tiporegistro_id', $user->tiporegistro_id)
                    ->where('user_id', $admin->sub)
                    ->updateOrCreate($params_array);

        if(!empty($recertcertificado) && is_object($recertcertificado)){

            //Actualizar el registro en concreto
            $recertcertificado->update($params_array);

            // devolver respuesta
            $data = array(
                'code' => 200,
                'status' => 'success',
                'recertcertificado' => $recertcertificado,
                'changes' => $params_array
            );
        }


        // actualizar registro
        $recertcertificado = RecertCertificado::where('id', $id)
                    ->where('user_id', $user->sub)
                    ->where('tiporegistro_id', $user->tiporegistro_id)
                    ->updateOrCreate($params_array);




        }


        return response()->json($data, $data['code']);
    }

    public function destroy($id, Request $request){

        // conseguir el usuario identificado
        $user = $this->getIdentity($request);


        // conseguir el post
        $recertcertificado =  RecertCertificado::where('id', $id)
                        ->where('user_id', $user->sub)
                        ->where('tiporegistro_id', $user->tiporegistro_id)
                        ->first();

        if(!empty($certificado)){

            // borrar
            $recertcertificado->delete();
            // devolver respuesta
            $data = [
                'code' => 200,
                'status' => 'success',
                'recertcertificado' => $recertcertificado
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

            \Storage::disk('recertcertificado')->put($filepdf_name, \File::get($filepdf));

            //obtener el  pago para almacenar la direccion del pdf
               //$user_auxiliar=User::find($user->sub);
               $recertificado_auxiliar=RecertCertificado::where('user_id', $user->sub)->first();
               
               //response()->json($pago_auxiliar,'estoy en pagos');
               //almaceno la direccion del pago
               $recertificado_auxiliar->cert_act_academicas_y_asistenciales_pdf=$filepdf_name;
               $recertificado_auxiliar->trab_esp_y_art_cientificos_pdf=$filepdf_name;
               $recertificado_auxiliar->act_editor_revisor_pub_cient_pdf=$filepdf_name;
               $recertificado_auxiliar->cert_asist_simposio_de_especialidad_pdf=$filepdf_name;
               $recertificado_auxiliar->cert_asist_simposio_no_especialidad_pdf=$filepdf_name;
               $recertificado_auxiliar->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'filepdf' => $filepdf_name
            ];

        }
        // devolver datos
        return response()->json($data, $data['code']);
    }

    public function getFilePdf($filename){
        // comprobar si existe
        $isset = \Storage::disk('recertcertificado')->exists($filename);

        if($isset){
            //conseguir la imagen
            $file = \Storage::disk('recertcertificado')->get($filename);
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



    public function getRecertificadoByUser($id){
        $recertcertificados = RecertCertificado::where('user_id', $id)->get()->load('user');

        return response()->json([
            'status' => 'success',
            'recertcertificados' => $recertcertificados
        ], 200);
    }
}
