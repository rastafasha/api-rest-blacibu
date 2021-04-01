<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Admin;

class JwtAuth{

    public $key;

    public function __construct(){
        $this->key = 'esto_es_una_clave_super_secreta-9988776645';
    }

    public function signup( $email, $password, $getToken = null){
        // buscar si existe el usuario con sus credenciales
        $user = User::where([
            'email' => $email,
            'password' => $password,
        ])->first();


    // comprobar si son correctas
    $signup = false;
    if(is_object($user)){
        $signup = true;
    }
    // generar el token con los datos del usuario identificado se obtiene desde la bd
    if($signup){
        $token = array(
            'sub' => $user->id,
            'user_post_id' => $user->user_post_id,
            'tiporegistro_id' => $user->tiporegistro_id,
            'status_id' => $user->status_id,
            'email' => $user->email,
            'name' => $user->name,
            'surname' => $user->surname,
            'pais' => $user->pais,
            'idioma' => $user->idioma,
            'image' => $user->image,
            'role' => $user->role,
            'iat' => time(),
            'exp' => time() +(7 * 24 * 60 * 60) // tiempo de expiracion del token
        );



        $jwt = JWT::encode($token, $this->key, 'HS256');
        $decoded = JWT::decode($jwt, $this->key, ['HS256']);

        // devolver los datos decodificados o el token, en funcion de un parametro

        if(is_null($getToken)){
            $data = $jwt;
        }else{
            $data = $decoded;
        }

    }else{
        $data = array(
            'status' => 'error',
            'message'=> 'login incorrecto'
        );
    }

    return $data;

    }



    public function checkToken($jwt, $getIdentity =  false){
        $auth = false;
        
        try{
            $jwt = str_replace('"', '', $jwt);
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
            
            
        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e){
            $auth = false;
        }
        
        if(!empty($decoded) && is_object($decoded) && isset($decoded->sub)){
            $auth = true;  
        }else{
            $auth = false;
        }
        
        if($getIdentity){
            return $decoded;
        }
        
        return $auth;
    }


// admin




public function signupAdmin( $email, $password, $getToken = null){
    // buscar si existe el usuario con sus credenciales
    $admin = Admin::where([
        'email' => $email,
        'password' => $password
    ])->first();


    // comprobar si son correctas
    $signupAdmin = false;
    if(is_object($admin)){
        $signupAdmin = true;
}
// generar el token con los datos del usuario identificado se obtiene desde la bd
if($signupAdmin){
    $token = array(
        'sub' => $admin->id,
            'email' => $admin->email,
            'name' => $admin->name,
            'surname' => $admin->surname,
            'pais' => $admin->pais,
            'idioma' => $admin->idioma,
            'tiporegistro_id' => $admin->tiporegistro_id,
            'status_id' => $admin->status_id,
            'image' => $admin->image,
            'role' => $admin->role,
            'iat' => time(),
            'exp' => time() +(7 * 24 * 60 * 60) // tiempo de expiracion del token


    );

    $jwt = JWT::encode($token, $this->key, 'HS256');
    $decoded = JWT::decode($jwt, $this->key, ['HS256']);

    // devolver los datos decodificados o el token, en funcion de un parametro

    if(is_null($getToken)){
        $data = $jwt;
    }else{
        $data = $decoded;
    }

    }else{
        $data = array(
            'status' => 'error',
            'message'=> 'login incorrecto'
        );
    }

    return $data;

}


public function checkTokenAdmin($jwt, $getIdentity =  false){
    $auth = false;

    try{
        $jwt = str_replace('""', '', $jwt);
        //$decoded = JWT::decoded($jwt, $this->key, ['HS256']);
    }catch(\UnexpectedValueException $e){
        $auth = false;
    }catch(\DomainException $e){
        $auth = false;
    }

    if(!empty($decoded) && is_object($decoded) && isset($decoded->sub)){
        $auth = true;
    }else {
        $auth = false;
    }

    if($getIdentity){
        return $decoded;
    }

    return $auth;
}


}
