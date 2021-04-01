<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Reponse;

use App\RecertConferencia;
use App\Helpers\JwtAuth;

class RecertConferenciaController extends Controller
{
    public function __construct(){
        $this->middleware('api.auth',['except' => [
            'index',
            'show',
            'update',
            'upload',
            'getFilePdf',
            'getRecertConferenciaByUser'
            ]]);
    }

    public function index(){
        $recertconferencias = RecertConferencia::all()->Load('tiporegistros')
        ->load('user');

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'recertconferencias' => $recertconferencias
        ], 200);
    }

    public function show($id){
        $recertconferencia = RecertConferencia::find($id)->load('recertconferencia')
                                ->load('user');


        if(is_object($recertconferencia)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'recertconferencia' => $recertconferencia
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La conferencia o afiliación no existe'
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
                'conf_nac_inter_evento' => 'required',
                'conf_nac_inter_titulo' => 'required'
            ]);

            if($validate->fails()){
                $data = [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'No se ha guardado la información, faltan datos'
                ];
            }else{
                // guardar el post
                $recertconferencia = new RecertConferencia();
                $recertconferencia->user_id = $user->sub;
                $recertconferencia->tiporegistro_id = $params->tiporegistro_id;
                $recertconferencia->conf_nac_inter_titulo = $params->conf_nac_inter_titulo;
                $recertconferencia->conf_nac_inter_evento = $params->conf_nac_inter_evento;
                $recertconferencia->conf_nac_inter_pdf = $params->conf_nac_inter_pdf;
                $recertconferencia->conf_nac_inter_status_id = $params->conf_nac_inter_status_id;
                $recertconferencia->conf_nac_inter_cialacibu_titulo = $params->conf_nac_inter_cialacibu_titulo;
                $recertconferencia->conf_nac_inter_cialacibu_evento = $params->conf_nac_inter_cialacibu_evento;
                $recertconferencia->conf_nac_inter_cialacibu_pdf = $params->conf_nac_inter_cialacibu_pdf;
                $recertconferencia->conf_nac_inter_cialacibu_status_id = $params->conf_nac_inter_cialacibu_status_id;
                $recertconferencia->afilia_asosc_odont_nac_extran_nombre = $params->afilia_asosc_odont_nac_extran_nombre;
                $recertconferencia->afilia_asosc_odont_nac_extran_cargo = $params->afilia_asosc_odont_nac_extran_cargo;
                $recertconferencia->afilia_asosc_odont_nac_extran_categoria = $params->afilia_asosc_odont_nac_extran_categoria;
                $recertconferencia->afilia_asosc_odont_nac_extran_gremio = $params->afilia_asosc_odont_nac_extran_gremio;
                $recertconferencia->afilia_asosc_odont_nac_extran_pdf = $params->afilia_asosc_odont_nac_extran_pdf;
                $recertconferencia->afilia_asosc_odont_nac_extran_status_id = $params->afilia_asosc_odont_nac_extran_status_id;
                $recertconferencia->colaboracion_acade_para_blacibu_figura = $params->colaboracion_acade_para_blacibu_figura;
                $recertconferencia->colaboracion_acade_para_blacibu_ano = $params->colaboracion_acade_para_blacibu_ano;
                $recertconferencia->colaboracion_acade_para_blacibu_funcion = $params->colaboracion_acade_para_blacibu_funcion;
                $recertconferencia->colaboracion_acade_para_blacibu_pdf = $params->colaboracion_acade_para_blacibu_pdf;
                $recertconferencia->colaboracion_acade_para_blacibu_status_id = $params->colaboracion_acade_para_blacibu_status_id;
                $recertconferencia->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'recertconferencia' => $recertconferencia
                ];

            }


        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No se ha guardado la conferencia o afiliación, faltan datos'
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
            'conf_nac_inter_titulo' => 'required',
            'conf_nac_inter_evento' => 'required'
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
        $recertconferencia = RecertConferencia::where('id', $id)
                    ->where('user_id', $user->sub)
                    ->where('tiporegistro_id', $user->tiporegistro_id)
                    ->where('user_id', $admin->sub)
                    ->updateOrCreate($params_array);

        if(!empty($recertconferencia) && is_object($recertconferencia)){

            //Actualizar el registro en concreto
            $recertconferencia->update($params_array);

            // devolver respuesta
            $data = array(
                'code' => 200,
                'status' => 'success',
                'recertconferencia' => $recertconferencia,
                'changes' => $params_array
            );
        }


        // actualizar registro
        $recertconferencia = RecertConferencia::where('id', $id)
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
        $recertconferencia =  RecertConferencia::where('id', $id)
                        ->where('user_id', $user->sub)
                        ->first();

        if(!empty($recertconferencia)){

            // borrar
            $recertconferencia->delete();
            // devolver respuesta
            $data = [
                'code' => 200,
                'status' => 'success',
                'recertconferencia' => $recertconferencia
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'la conferencia o afiliación no existe'
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
        //$user_auxiliar=User::find($user->sub);
    
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
           // \Storage::disk('users')->put($image_name, \File::get($image));
           \Storage::disk('recertconferencias')->put($filepdf_name, \File::get($filepdf));

           
               //obtener el  pago para almacenar la direccion del pdf
               //$user_auxiliar=User::find($user->sub);
               $recertconferencia_auxiliar=Pago::where('user_id', $user->sub)->first();
               
               //response()->json($pago_auxiliar,'estoy en pagos');
               //almaceno la direccion del pago
               $recertconferencia_auxiliar->conf_nac_inter_pdf=$filepdf_name;
               $recertconferencia_auxiliar->conf_nac_inter_cialacibu_pdf=$filepdf_name;
               $recertconferencia_auxiliar->afilia_asosc_odont_nac_extran_pdf=$filepdf_name;
               $recertconferencia_auxiliar->colaboracion_acade_para_blacibu_pdf=$filepdf_name;
               $recertconferencia_auxiliar->save();
               
               
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
        $isset = \Storage::disk('recertconferencias')->exists($filename);

        if($isset){
            //conseguir la imagen
            $file = \Storage::disk('recertconferencias')->get($filename);
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

    public function getRecertConferenciaByUser($id){
        $recertconferencias = RecertConferencia::where('user_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'recertconferencias' => $recertconferencias
        ], 200);
    }
}
