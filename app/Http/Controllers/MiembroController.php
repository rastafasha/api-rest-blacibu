<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Reponse;

use App\Miembro;
use App\User;
use App\UserPost;
use App\Helpers\JwtAuth;


class MiembroController extends Controller
{
    public function __construct(){
        $this->middleware('api.auth',['except' => [
            'index',
            'show',
            'getFilePdf',
            'getMiembroByUser',
            'upload',
            'update',
            ]]);
    }

    public function index(){
        $miembros = Miembro::all()->Load('tiporegistros');

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'miembros' => $miembros
        ], 200);
    }




    public function show($id){
        $miembro = Miembro::find($id)->load('miembro')
                                ->load('user');


        if(is_object($miembro)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'miembro' => $miembro
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'El miembro no existe'
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
                'numero_miembro' => 'required',
                'ano_certificacion' => 'required'
            ]);

            if($validate->fails()){
                $data = [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'No se ha guardado la información, faltan datos'
                ];
            }else{
                // guardar el post
                $miembro = new Miembro();
                $miembro->user_id = $user->sub;
                $miembro->tiporegistro_id = $params->tiporegistro_id;
                $miembro->numero_miembro = $params->numero_miembro;
                $miembro->ano_certificacion = $params->ano_certificacion;
                $miembro->tiempo_titulado = $params->tiempo_titulado;
                $miembro->ano_graduado = $params->ano_graduado;
                $miembro->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'miembro' => $miembro
                ];

            }


        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No se ha guardado el miembro, faltan datos'
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
            'miembro' => $params_array
        );

        if(!empty($params_array)){
            // validar los datos
            $validate = \Validator::make($params_array, [
            'name' => 'required',
            'surname' => 'required'
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
            $miembro = Miembro::where('id', $id)
                        ->where('user_id', $user->sub)
                        ->where('user_post_id', $user->sub)
                        ->where('tiporegistro_id', $user->tiporegistro_id)
                        ->updateOrCreate($params_array);

            if(!empty($miembro) && is_object($miembro)){

                //Actualizar el registro en concreto
                $miembro->update($params_array);

                // devolver respuesta
                $data = array(
                    'code' => 200,
                    'status' => 'success',
                    'miembro' => $miembro,
                    'changes' => $params_array
                );
            }


            // actualizar registro
            $miembro = Miembro::where('id', $id)
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
        $miembro =  Miembro::where('id', $id)
                        ->where('user_id', $user->sub)
                        ->where('user_post_id', $user->sub)
                        ->where('tiporegistro_id', $user->tiporegistro_id)
                        ->first();

        if(!empty($miembro)){

            // borrar
            $miembro->delete();
            // devolver respuesta
            $data = [
                'code' => 200,
                'status' => 'success',
                'miembro' => $miembro
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'el miembro no existe'
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

   

    


    public function getMiembroByUser($id){
        $miembros = Miembro::where('user_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'miembros' => $miembros
        ], 200);
    }
}
