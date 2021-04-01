<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


use App\Admin;
use App\User;

class AdminUserController extends Controller
{
    
    
    
    public function alladmin(){
        $admines = Admin::all();;

        if(is_object($admines)){
            $data = array(
                'status' => 'success',
                'code' => 200,
                'admines' => $admines
            );
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
            );
        }

        return response()->json($data, $data['code']);
    }

    public function users(){
        $users = User::all();

        if(is_object($users)){
            $data = array(
                'status' => 'success',
                'code' => 200,
                'users' => $users
            );
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
            );
        }

        return response()->json($data, $data['code']);
    }


    // user detail
    public function detail($id){
        $user = User::find($id)
        ->load('certificados')
        ->load('conferencias')
        ->load('documentos')
        ->load('miembros')
        ->load('pagos')
        ->load('recertcertificados')
        ->load('recertconstancias')
        ->load('recertconferencias');

        if(is_object($user)){
            $data = array(
                'status' => 'success',
                'code' => 200,
                'user' => $user,

            );
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'mesaje' => 'El usuario no existe.',
            );
        }

        return response()->json($data, $data['code']);
    }







}
