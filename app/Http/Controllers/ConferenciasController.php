<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Reponse;

use App\ConferenciasyTrabajos;
use App\User;
use App\Helpers\JwtAuth;

class ConferenciasController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except' => [
            'index',
            'show',
            'update',
            'upload',
            'getFilePdf',
            'getPostsByCategory',
            'getConferenciaByUser'
            ]]);
    }

    public function index(){
        $conferencias = ConferenciasyTrabajos::all()->Load('tiporegistros')
        ->load('user');

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'conferencias' => $conferencias
        ], 200);
    }

    public function show($id){
        $conferencia = ConferenciasyTrabajos::find($id)->load('conferencias')
                                ->load('user');


        if(is_object($conferencia)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'conferencias' => $conferencia
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La conferencia no existe'
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
                'name' => 'required|alpha',
                'surname' => 'required|alpha',
                'email' => 'required|email|unique:users,'.$user->sub
            ]);

            if($validate->fails()){
                $data = [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'No se ha guardado la información, faltan datos'
                ];
            }else{
                // guardar el post
                $conferencia = new ConferenciasyTrabajos();
                $conferencia->user_id = $user->sub;
                $conferencia->tiporegistro_id = $params->tiporegistro_id;
                $conferencia->conf_con_aval_academico_titulo = $params->conf_con_aval_academico_titulo;
                $conferencia->conf_con_aval_academico_evento = $params->conf_con_aval_academico_evento;
                $conferencia->conf_con_aval_academico_pdf = $params->conf_con_aval_academico_pdf;
                $conferencia->conf_con_aval_academico_status_id = $params->conf_con_aval_academico_status_id;
                $conferencia->conf_sin_aval_academico_titulo = $params->conf_sin_aval_academico_titulo;
                $conferencia->conf_sin_aval_academico_evento = $params->conf_sin_aval_academico_evento;
                $conferencia->conf_sin_aval_academico_pdf = $params->conf_sin_aval_academico_pdf;
                $conferencia->conf_sin_aval_academico_status_id = $params->conf_sin_aval_academico_status_id;
                $conferencia->trab_pres_con_aval_titulo = $params->trab_pres_con_aval_titulo;
                $conferencia->trab_pres_con_aval_evento = $params->trab_pres_con_aval_evento;
                $conferencia->trab_pres_con_aval_modalidad = $params->trab_pres_con_aval_modalidad;
                $conferencia->trab_pres_con_aval_pdf = $params->trab_pres_con_aval_pdf;
                $conferencia->trab_pres_con_aval_status_id = $params->trab_pres_con_aval_status_id;
                $conferencia->trab_pres_sin_aval_evento = $params->trab_pres_sin_aval_evento;
                $conferencia->trab_pres_sin_aval_modalidad = $params->trab_pres_sin_aval_modalidad;
                $conferencia->trab_pres_sin_aval_pdf = $params->trab_pres_sin_aval_pdf;
                $conferencia->trab_pres_sin_aval_status_id = $params->trab_pres_sin_aval_status_id;
                $conferencia->trab_publicados_nombre = $params->trab_publicados_nombre;
                $conferencia->trab_publicados_ano = $params->trab_publicados_ano;
                $conferencia->trab_publicados_revisa = $params->trab_publicados_revisa;
                $conferencia->trab_publicados_pdf = $params->trab_publicados_pdf;
                $conferencia->trab_publicados_status_id = $params->trab_publicados_status_id;
                $conferencia->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'conferencia' => $conferencia
                ];

            }


        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No se ha guardado el post, faltan datos'
            ];
        }


        // devolver respuesta
        return response()->json($data, $data['code']);
    }

    public function update( $id, Request $request){
        // recoger los datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        // datos para devolver
        $data = array(
            'code' => 200,
            'status' => 'success',
            'conferencia' => $params_array
        );

        if(!empty($params_array)){
            // validar los datos
            $validate = \Validator::make($params_array, [
                'name' => '',
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

        unset($params_array['conf_con_aval_academico_titulo']);
         unset($params_array['conf_con_aval_academico_evento']);
         unset($params_array['conf_con_aval_academico_pdf']);
         unset($params_array['conf_sin_aval_academico_titulo']);
         unset($params_array['conf_sin_aval_academico_evento']);
         unset($params_array['conf_sin_aval_academico_pdf']);
         unset($params_array['trab_pres_con_aval_titulo']);
         unset($params_array['trab_pres_con_aval_evento']);
         unset($params_array['trab_pres_con_aval_modalidad']);
         unset($params_array['trab_pres_con_aval_pdf']);
         unset($params_array['trab_pres_sin_aval_titulo']);
         unset($params_array['trab_pres_sin_aval_evento']);
         unset($params_array['trab_pres_sin_aval_modalidad']);
         unset($params_array['trab_pres_sin_aval_pdf']);
         unset($params_array['trab_publicados_nombre']);
         unset($params_array['trab_publicados_ano']);
         unset($params_array['trab_publicados_revisa']);
         unset($params_array['trab_publicados_pdf']);

         // campos duplicables o dinamicos
         $conf_con_aval_academico_titulo = $params_array['conf_con_aval_academico_titulo'];
         $conf_con_aval_academico_evento=$params_array['conf_con_aval_academico_evento'];
         $conf_con_aval_academico_pdf=$params_array['conf_con_aval_academico_pdf'];

         foreach ($params_array['preguntas'] as $confTiulo) {
            $conf_con_aval_academico_titulo=$conf_con_aval_academico_titulo.';'.$confTiulo['conf_con_aval_academico_titulo'];
            $conf_con_aval_academico_evento=$conf_con_aval_academico_evento.';'.$confTiulo['conf_con_aval_academico_evento'];
            $conf_con_aval_academico_pdf=$conf_con_aval_academico_pdf.';'.$confTiulo['conf_con_aval_academico_pdf'];
        }

         $conf_sin_aval_academico_titulo = $params_array['conf_sin_aval_academico_titulo'];
         $conf_sin_aval_academico_evento=$params_array['conf_sin_aval_academico_evento'];
         $conf_sin_aval_academico_pdf=$params_array['conf_sin_aval_academico_pdf'];

         foreach ($params_array['preguntas1'] as $certAsistnoNombre) {
            $conf_sin_aval_academico_titulo=$conf_sin_aval_academico_titulo.';'.$certAsist['conf_sin_aval_academico_titulo'];
            $conf_sin_aval_academico_evento=$conf_sin_aval_academico_evento.';'.$certAsist['conf_sin_aval_academico_evento'];
            $conf_sin_aval_academico_pdf=$conf_sin_aval_academico_pdf.';'.$certAsist['conf_sin_aval_academico_pdf'];
        }
         
         $trab_pres_con_aval_titulo = $params_array['trab_pres_con_aval_titulo'];
         $trab_pres_con_aval_evento=$params_array['trab_pres_con_aval_evento'];
         $trab_pres_con_aval_modalidad=$params_array['trab_pres_con_aval_modalidad'];
         $trab_pres_con_aval_pdf=$params_array['trab_pres_con_aval_pdf'];

         foreach ($params_array['preguntas2'] as $certAsistnoNombre) {
            $trab_pres_con_aval_titulo=$trab_pres_con_aval_titulo.';'.$certAsist['trab_pres_con_aval_titulo'];
            $trab_pres_con_aval_evento=$trab_pres_con_aval_evento.';'.$certAsist['trab_pres_con_aval_evento'];
            $trab_pres_con_aval_modalidad=$trab_pres_con_aval_modalidad.';'.$certAsist['trab_pres_con_aval_modalidad'];
            $trab_pres_con_aval_pdf=$trab_pres_con_aval_pdf.';'.$certAsist['trab_pres_con_aval_pdf'];
        }
         
         $trab_pres_sin_aval_titulo = $params_array['trab_pres_sin_aval_titulo'];
         $trab_pres_sin_aval_evento=$params_array['trab_pres_sin_aval_evento'];
         $trab_pres_sin_aval_modalidad=$params_array['trab_pres_sin_aval_modalidad'];
         $trab_pres_sin_aval_pdf=$params_array['trab_pres_sin_aval_pdf'];

         foreach ($params_array['preguntas3'] as $certAsistnoNombre) {
            $trab_pres_sin_aval_titulo=$trab_pres_sin_aval_titulo.';'.$certAsist['trab_pres_sin_aval_titulo'];
            $trab_pres_sin_aval_evento=$trab_pres_sin_aval_evento.';'.$certAsist['trab_pres_sin_aval_evento'];
            $trab_pres_sin_aval_modalidad=$trab_pres_sin_aval_modalidad.';'.$certAsist['trab_pres_sin_aval_modalidad'];
            $trab_pres_sin_aval_pdf=$trab_pres_sin_aval_pdf.';'.$certAsist['trab_pres_sin_aval_pdf'];
        }
         
         $trab_publicados_nombre = $params_array['trab_publicados_nombre'];
         $trab_publicados_ano=$params_array['trab_publicados_ano'];
         $trab_publicados_revisa=$params_array['trab_publicados_revisa'];
         $trab_publicados_pdf=$params_array['trab_publicados_pdf'];
         
         
         foreach ($params_array['preguntas4'] as $certAsistnoNombre) {
             $trab_publicados_nombre=$trab_publicados_nombre.';'.$certAsist['trab_publicados_nombre'];
             $trab_publicados_ano=$trab_publicados_ano.';'.$certAsist['trab_publicados_ano'];
             $trab_publicados_revisa=$trab_publicados_revisa.';'.$certAsist['trab_publicados_revisa'];
             $trab_publicados_pdf=$trab_publicados_pdf.';'.$certAsist['trab_publicados_pdf'];
         }
         unset($params_array['preguntas']);
         unset($params_array['preguntas1']);
         unset($params_array['preguntas2']);
         unset($params_array['preguntas3']);
         

        // conseguir el usuario identificado
        //$user = $this->getIdentity($request);
        // conseguir el usuario identificado
        $jwtAuth = new JwtAuth();
        $token = $request->header('Authorization', null);
        $user = $jwtAuth->checkToken($token, true);

        //buscar el registro
        $conferencia = ConferenciasyTrabajos::where('id', $id)
                    ->where('user_id', $user->sub)
                    ->where('user_post_id', $user->sub)
                    ->where('tiporegistro_id', $user->tiporegistro_id)
                    ->where('user_id', $admin->sub)
                    ->updateOrCreate($params_array);

        if(!empty($conferencia) && is_object($conferencia)){

            //Actualizar el registro en concreto
            $conferencia->update($params_array);

            // devolver respuesta
            $data = array(
                'code' => 200,
                'status' => 'success',
                'conferencia' => $conferencia,
                'changes' => $params_array
            );
        }


        // actualizar registro
        $conferencia = ConferenciasyTrabajos::where('id', $id)
                    ->where('user_id', $user->sub)
                    ->where('user_post_id', $user->sub)
                    ->where('tiporegistro_id', $user->tiporegistro_id)
                    ->updateOrCreate($params_array);




        }


        return response()->json($data, $data['code']);
    }

    public function destroy($id, Request $request){

        // conseguir el usuario identificado
        $user = $this->getIdentity($request);


        // conseguir el post
        $conferencia =  ConferenciasyTrabajos::where('id', $id)
                        ->where('user_id', $user->sub)
                        ->where('user_post_id', $user->sub)
                        ->first();

        if(!empty($conferencia)){

            // borrar
            $conferencia->delete();
            // devolver respuesta
            $data = [
                'code' => 200,
                'status' => 'success',
                'conferencia' => $conferencia
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

            $conferencia_auxiliar=User::find($user->sub);    

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

            \Storage::disk('conferencias')->put($filepdf_name, \File::get($filepdf));

            //return response($filepdf_name);

             //obtener el  pago para almacenar la direccion del pdf
               //$user_auxiliar=User::find($user->sub);
               $conferencia_auxiliar=Conferencia::where('user_id', $user->sub)->first();
               
               //response()->json($pago_auxiliar,'estoy en pagos');
               //almaceno la direccion del pago
               $conferencia_auxiliar->conf_con_aval_academico_pdf=$filepdf_name;
               $conferencia_auxiliar->conf_sin_aval_academico_pdf=$filepdf_name;
               $conferencia_auxiliar->trab_pres_con_aval_pdf=$filepdf_name;
               $conferencia_auxiliar->trab_pres_sin_aval_pdf=$filepdf_name;
               $conferencia_auxiliar->trab_publicados_pdf=$filepdf_name;

               $conferencia_auxiliar->save();


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
        $isset = \Storage::disk('conferencias')->exists($filename);

        if($isset){
            //conseguir la imagen
            $file = \Storage::disk('conferencias')->get($filename);
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

    

    public function getConferenciaByUser($id){
        $conferencias = ConferenciasyTrabajos::where('user_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'conferencias' => $conferencias
        ], 200);
    }
}
