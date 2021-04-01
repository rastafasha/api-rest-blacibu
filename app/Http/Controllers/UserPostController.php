<?php

namespace App\Http\Controllers;


use App\Helpers\JwtAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Reponse;

use App\UserPost;
use App\User;
use App\Admin;
use App\AdminUser;
use App\Certificado;
use App\ConferenciasyTrabajos;
use App\Documento;
use App\Estado;
use App\Pago;
use App\RecertCertificado;
use App\RecertConferencia;
use App\RecertConstancia;
use App\TipoRegistro;

class UserPostController extends Controller
{

    public function __construct(){
        $this->middleware('api.auth',['except' => [
            'index',
            'show',
            'update',
            'destroy',
            'getImage',
            'getUserPostsByEstado',
            'getUserPostsByTipoRegistro',
            'getPostsByUser',
            'tiporegistroUsers',
            'getEstados'
            ]]);
    }

    public function index(){
        $userposts = UserPost::all();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'userposts' => $userposts
        ], 200);
    }

    public function tiporegistroUsers(){
        $userposts = TipoRegistro::find($id)->load('users');

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'userposts' => $userposts
        ], 200);
    }

    public function show($id){
        $userpost = UserPost::find($id)
        ->load('certificados')
        ->load('tiporegistros')
        ->load('conferencias')
        ->load('documentos')
        ->load('miembros')
        ->load('pagos')
        ->load('recertcertificados')
        ->load('recertconstancias')
        ->load('recertconferencias');


        if(is_object($userpost)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'userpost' => $userpost
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
            $user = $this->getIdentity($request);

            // Validar los datos
            $validate = \Validator::make($params_array, [
                'title' => 'required',
                'content' => 'required',
                'category_id' => 'required',
                'image' => 'required'
            ]);

            if($validate->fails()){
                $data = [
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'No se ha guardado el post, faltan datos'
                ];
            }else{
                // guardar el post
                $post = new Post();
                $post->user_id = $user->sub;
                $post->category_id = $params->category_id;
                $post->title = $params->title;
                $post->content = $params->content;
                $post->image = $params->image;
                $post->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'post' => $post
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

    public function update($id, Request $request){
        // recoger los datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        // datos para devolver
        $data = array(
            'code' => 200,
            'status' => 'success',
            'userpost' => $params_array
        );

        if(!empty($params_array)){

            // validar los datos
            $validate = \Validator::make($params_array, [
                'name' => 'required'
            ]);

            if($validate->fails()){

                $data['errors'] = $validate->errors();

                return response()->json($data, $data['code']);
            }

            // eliminar lo que no queremos actualizar
            unset($params_array['id']);
            unset($params_array['user_id']);
            unset($params_array['created_at']);
            unset($params_array['user']);
            unset($params_array['admin']);

            // conseguir el usuario identificado
            $admin = $this->checkTokenAdmin($request);

            //buscar el registro
            $userpost = UserPost::where('status_id', $id)
                        ->where('user_id', $user->sub)
                        ->updateOrCreate($params_array);

            if(!empty($userpost) && is_object($userpost)){

                //Actualizar el registro en concreto
                $userpost->update($params_array);

                // devolver respuesta
                $data = array(
                    'code' => 200,
                    'status' => 'success',
                    'userpost' => $userpost,
                    'changes' => $params_array
                );
            }


            // actualizar registro
            $userpost = UserPost::where('status_id', $id)
                        ->where('user_id', $user->sub)
                        ->updateOrCreate($params_array);




        }


        return response()->json($data, $data['code']);
    }

    public function destroy($id, Request $request){


        // conseguir el post
        $userpost = UserPost::where('id', $id)
                    ->where('user_post_id', $user->sub)
                        ->first();

        if(!empty($userpost)){

            // borrar
            $userpost->delete();
            // devolver respuesta
            $data = [
                'code' => 200,
                'status' => 'success',
                'userpost' => $userpost
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

    private function getIdentityAdmin($request){
        $jwtAuth = new JwtAuth();
        $token = $request->header('Authorization', null);
        $admin = $jwtAuth->checkTokenAdmin($token, true);

        return $admines;
    }



    public function getUserPostsByEstado($id){
        $userpost = UserPost::where('status_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'userpost' => $userpost
        ], 200);
    }

    public function getUserPostsByTipoRegistro($id){
        $userpost = UserPost::where('tiporegistro_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'userpost' => $userpost
        ], 200);
    }

    public function getPostsByUser($id){
        $userpost = UserPost::where('id', $id)
        ->get()
        ->load('certificados')
        ->load('conferencias')
        ->load('documentos')
        ->load('miembros')
        ->load('pagos')
        ->load('recertcertificados')
        ->load('recertconstancias')
        ->load('recertconferencias');

        return response()->json([
            'status' => 'success',
            'userpost' => $userpost
        ], 200);
    }





}

