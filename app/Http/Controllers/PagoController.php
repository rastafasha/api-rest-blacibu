<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Reponse;

use App\Pago;
use App\User;
use App\Helpers\JwtAuth;

class PagoController extends Controller
{
    public function __construct(){
        $this->middleware('api.auth',['except' => [
            'index',
            'show',
            'getFilePdf',
            'getPagosByTipoRegistro',
            'getPagoByUser',
            'upload',
            'update',
            ]]);
    }

    public function index(){
        $pagos = Pago::all()->Load('tiporegistros');

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'pagos' => $pagos
        ], 200);
    }




    public function show($id){
        $pago = Pago::find($id)->load('pago')
                                ->load('user');


        if(is_object($pago)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'pago' => $pago
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'El pago no existe'
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
                'tiporegistro_id' => 'required',
                'transf_banco' => 'required',
                'user_id' => 'required',
                'transf_pdf' => 'required',
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
                $pago = new Pago();
                $pago->user_id = $user->sub;
                $pago->tiporegistro_id = $params->tiporegistro_id;
                $pago->transf_banco = $params->transf_banco;
                $pago->transf_fecha = $params->transf_fecha;
                $pago->transf_pdf = $params->transf_pdf;
                $pago->transf_pdf_status_id = $params->transf_pdf_status_id;
                $pago->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'pago' => $pago
                ];

            }


        }else{
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No se ha guardado el pago, faltan datos'
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
            $pago = Pago::where('id', $id)
                        ->where('user_id', $user->sub)
                        ->where('user_post_id', $user->sub)
                        ->where('tiporegistro_id', $user->tiporegistro_id)
                        ->where('user_id', $admin->sub)
                        ->updateOrCreate($params_array);

            if(!empty($pago) && is_object($pago)){

                //Actualizar el registro en concreto
                $pago->update($params_array);

                // devolver respuesta
                $data = array(
                    'code' => 200,
                    'status' => 'success',
                    'pago' => $pago,
                    'changes' => $params_array
                );
            }


            // actualizar registro
            $pago = Pago::where('id', $id)
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
        $pago =  Pago::where('id', $id)
                        ->where('user_id', $user->sub)
                        ->where('user_post_id', $user->sub)
                        ->where('tiporegistro_id', $user->tiporegistro_id)
                        ->first();

        if(!empty($pago)){

            // borrar
            $pago->delete();
            // devolver respuesta
            $data = [
                'code' => 200,
                'status' => 'success',
                'pago' => $pago
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'el pago no existe'
            ];
        }

        return response()->json($data, $data['code']);
    }

/// get identity
    private function getIdentity($request){

        // conseguir el usuario identificado
        $jwtAuth = new JwtAuth();
        $token = $request->header('Authorization', null);
        $user = $jwtAuth->checkToken($token, true);

        return $users;
    }

    private function getIdentityAdmin($request){

        // conseguir el usuario identificado
        $jwtAuth = new JwtAuth();
        $token = $request->header('Authorization', null);
        $admin = $jwtAuth->checkToken($token, true);

        return $admins;
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
 
      $pago_auxiliar=User::find($user->sub);
    
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
           \Storage::disk('pagos')->put($filepdf_name, \File::get($filepdf));

           
               //obtener el  pago para almacenar la direccion del pdf
               //$user_auxiliar=User::find($user->sub);
               $pago_auxiliar=Pago::where('user_id', $user->sub)->first();
               
               //response()->json($pago_auxiliar,'estoy en pagos');
               //almaceno la direccion del pago
               $pago_auxiliar->transf_pdf=$filepdf_name;
               $pago_auxiliar->save();
               
               
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
        $isset = \Storage::disk('pagos')->exists($filename);

        if($isset){
            //conseguir la imagen
            $file = \Storage::disk('pagos')->get($filename);
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

    public function getPagosByTipoRegistro($id){
        $pagos = Pago::where('tiporegistro_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'pagos' => $pagos
        ], 200);
    }


    public function getPagoByUser($id){
        $pagos = Pago::where('user_id', $id)->get()->load('user');

        return response()->json([
            'status' => 'success',
            'pagos' => $pagos
        ], 200);
    }


}
