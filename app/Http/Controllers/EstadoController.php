<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Estado;
use App\User;
use App\UserPost;
use App\Admin;

class EstadoController extends Controller
{
    public function __construct(){
        $this->middleware('api.auth',['except' => [
            'index',
            'show',
            'detail'
            ]]);
    }


    public function index(){
        $estados = Estado::all();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'estados' => $estados
        ], 200);
    }

    public function show($id){
        $estado = Estado::find($id);

        if(is_object($estado)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'estado' => $estado
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La estado no existe.'
            ];
        }
        return response()->json($data, $data['code']);
    }


    public function store(Request $request){
        // Recoger los datos por post
        $json = $request->input('json',null);
        $params_array = json_decode($json, true);

        if(!empty($params_array)){



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
            $estado = new Estado();
            $estado->name = $params_array['name'];
            $estado->icon = $params_array['icon'];
            $estado->color = $params_array['color'];
            $estado->save();

            $data = [
                'code' => 200,
                'status' => 'success',
                'estado' => $estado
            ];


        };
    }else{
        $data = [
            'code' => 400,
            'status' => 'error',
            'message' => 'No has enviado ningún estado.'
        ];
    }
        // Devolver resultado
        return response()->json($data, $data['code']);

    }



    public function update($id, Request $request){
        // recoger los datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if(!empty($params_array)){

        // validar los datos
        $validar = \Validate::make($params_array, [
            'name' => 'required'
        ]);
        // quitar lo que no quiero actualizar
        unset($params_array['id']);
        unset($params_array['created_at']);

        // actualizar el registro(categoria)
        $estado = Estado::where('id', $id)->update($params_array);

        $data = [
            'code' => 200,
            'status' => 'success',
            'estado' => $params_array
        ];

    }else{
        $data = [
            'code' => 400,
            'status' => 'error',
            'message' => 'No has enviado ninguna estado.'
        ];
    }
        // devolver los datos
        return response()->json($data, $data['code']);
    }

    public function detail($id){
        $estado = User::where('status_id', $id)->get()->load('certificados')
        ->load('conferencias')
        ->load('documentos')
        ->load('miembros')
        ->load('pagos')
        ->load('recertcertificados')
        ->load('recertconstancias')
        ->load('recertconferencias');

        return response()->json([
            'status' => 'success',
            'estado' => $estado
        ], 200);
    }

    public function getPostsByUser($id){
        $estado = User::where('id', $id)->get()->load('certificados')
        ->load('conferencias')
        ->load('documentos')
        ->load('miembros')
        ->load('pagos')
        ->load('recertcertificados')
        ->load('recertconstancias')
        ->load('recertconferencias');

        return response()->json([
            'status' => 'success',
            'estado' => $estado
        ], 200);
    }
}
