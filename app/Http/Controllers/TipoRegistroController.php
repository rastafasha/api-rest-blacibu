<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\TipoRegistro;
use App\User;
use App\UserPost;

class TipoRegistroController extends Controller
{

    public function __construct(){
        $this->middleware('api.auth',['except' => [
            'index',
            'show',
            'update',
            'upload',
            'userstipo',
            'detail'
            ]]);
    }


    public function index(){
        $tiporegistros = TipoRegistro::all();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'tiporegistros' => $tiporegistros
        ], 200);
    }

    public function show($id){
        $tiporegistro = TipoRegistro::find($id);

        if(is_object($tiporegistro)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'tiporegistro' => $tiporegistro
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La tiporegistro no existe.'
            ];
        }
        return response()->json($data, $data['code']);
    }
    public function userstipo($id){

        $tiporegistros = UserPost::where('tiporegistro_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'tiporegistros' => $tiporegistros
        ], 200);
    }

    public function store(Request $request){
        // Recoger los datos por post
        $json = $request->input('json',null);
        $params_array = json_decode($json, true);

        if(!empty($params_array)){
            // conseguir el usuario identificado
            //$user = $this->getIdentity($request);
            // comprobar si el usuario esta autentificado
            $token = $request ->header('Authorization');
            $jwtAuth = new \JwtAuth();
            $checkToken = $jwtAuth->checkToken($token);


        // Validar los datos
        $validate =  \Validator::make($params_array, [
            'name' => 'required'
        ]);

        // Guardar la categoria
        if($validate->fails()){
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No se ha guardado la categoría.'
            ];
        }else{
            $tiporegistro = new TipoRegistro();
            $tiporegistro->name = $params_array['name'];
            $tiporegistro->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'tiporegistro' => $tiporegistro
            ];


        };
    }else{
        $data = [
            'code' => 400,
            'status' => 'error',
            'message' => 'No has enviado ninguna categoria.'
        ];
    }
        // Devolver resultado
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
            'tiporegistro' => $params_array
        );

        if(!empty($params_array)){
            // validar los datos
            $validate = \Validator::make($params_array, [
                'name' => 'required',
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
        $tiporegistro = TipoRegistro::where('id', $id)
                    ->where('user_id', $user->sub)
                    ->where('tiporegistro_id', $user->tiporegistro_id)
                    ->where('user_id', $admin->sub)
                    ->updateOrCreate($params_array);

        if(!empty($tiporegistro) && is_object($tiporegistro)){

            //Actualizar el registro en concreto
            $tiporegistro->update($params_array);

            // devolver respuesta
            $data = array(
                'code' => 200,
                'status' => 'success',
                'tiporegistro' => $tiporegistro,
                'changes' => $params_array
            );
        }


        // actualizar registro
        $tiporegistro = TipoRegistro::where('id', $id)
                    ->where('user_id', $user->sub)
                    ->where('tiporegistro_id', $user->tiporegistro_id)
                    ->updateOrCreate($params_array);

        }


        return response()->json($data, $data['code']);
    }

    public function detail($id){
        $tiporegistro = User::where('tiporegistro_id', $id)->get()->load('certificados')
        ->load('conferencias')
        ->load('documentos')
        ->load('miembros')
        ->load('pagos')
        ->load('recertcertificados')
        ->load('recertconstancias')
        ->load('recertconferencias');

        return response()->json([
            'status' => 'success',
            'tiporegistro' => $tiporegistro
        ], 200);
    }



}

