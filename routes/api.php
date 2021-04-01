<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//cargando clases
use App\Http\Middleware\ApiAuthMiddleware;


/*Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('user-profile', 'AuthController@userProfile');

    
});*/


//Rutas del controlador de Usuario
Route::group([
    'middleware' => 'api',
    'prefix' => 'user'

], function ($router) {
    Route::get('/', 'UserController@index');
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
    Route::put('update/{id}', 'UserController@update');
    Route::post('upload','UserController@upload');
    Route::get('avatar/{filename}','UserController@getImage');
    Route::get('detail/{id}','UserController@detail');
    Route::get('show/{id}', 'UserController@show');

    
});

//Rutas del controlador de Admin

Route::group([
    'middleware' => 'api',
    'prefix' => 'admin'

], function ($router) {
    Route::get('/', 'AdminController@index');
    Route::post('register', 'AdminController@register');
    Route::post('login', 'AdminController@login');
    Route::put('update/{id}', 'AdminController@update');
    Route::post('upload','AdminController@upload');
    Route::get('avatar/{filename}','AdminController@getImage');
    Route::get('detail/{id}','AdminController@detail');
    //usuarios
    Route::get('user/{id}', 'AdminUserController@detail');
    Route::get('users', 'AdminUserController@users');
    Route::get('admines', 'AdminUserController@alladmin');

    
});


//Rutas del controlador de pagos

Route::group([
    'middleware' => 'api',
    'prefix' => 'pago'

], function ($router) {
    Route::resource('/', 'PagoController');
    Route::post('upload', 'PagoController@upload');
    Route::put('update/{id}', 'UserController@update');
    Route::post('create/', 'PagoController@store');
    Route::delete('delete/{id}', 'PagoController@destroy');
    Route::get('file/{filename}', 'PagoController@getFilePdf');
    Route::get('user/{id}', 'PagoController@getPagoByUser');
    Route::get('tiporegistro/{id}', 'PagoController@getPagosByTipoRegistro');

    
});

//Rutas del controlador de miembros

Route::group([
    'middleware' => 'api',
    'prefix' => 'miembro'

], function ($router) {
    Route::resource('/', 'MiembroController');
    Route::post('upload', 'MiembroController@upload');
    Route::put('update/{id}', 'MiembroController@update');
    Route::post('create/', 'MiembroController@store');
    Route::delete('delete/{id}', 'MiembroController@destroy');
    Route::get('file/{filename}', 'MiembroController@getFilePdf');
    Route::get('user/{id}', 'MiembroController@getMiembroByUser');

  
});

//Rutas del controlador de documentos

Route::group([
    'middleware' => 'api',
    'prefix' => 'documento'

], function ($router) {
    Route::resource('/', 'DocumentoController');
    Route::post('upload/', 'DocumentoController@update');
    Route::put('update/{id}', 'DocumentoController@update');
    Route::post('create/', 'DocumentoController@store');
    Route::delete('delete/{id}', 'DocumentoController@destroy');
    Route::get('file/{filename}', 'DocumentoController@getDocument');
    Route::get('user/{id}', 'DocumentoController@getDocumentosByUser');

    
});


//Rutas del controlador de certificados

Route::group([
    'middleware' => 'api',
    'prefix' => 'certificado'

], function ($router) {
    Route::resource('/', 'CertificadoController');
    Route::post('upload', 'CertificadoController@update');
    Route::put('update/{id}', 'CertificadoController@update');
    Route::post('create/', 'CertificadoController@store');
    Route::delete('delete/{id}', 'CertificadoController@destroy');
    Route::get('file/{filename}', 'CertificadoController@getFilePdf');
    Route::get('user/{id}', 'CertificadoController@getCertificadoByUser');

    
});


//Rutas del controlador de conferencias

Route::group([
    'middleware' => 'api',
    'prefix' => 'conferencia'

], function ($router) {
    Route::resource('/', 'ConferenciasController');
    Route::post('upload/', 'ConferenciasController@update');
    Route::put('update/{id}', 'ConferenciasController@update');
    Route::post('create/', 'ConferenciasController@store');
    Route::delete('delete/{id}', 'ConferenciasController@destroy');
    Route::get('file/{filename}', 'ConferenciasController@getFilePdf');
    Route::get('user/{id}', 'ConferenciasController@getConferenciaByUser');

  
});



//Rutas del controlador de Recertificacion-Constancias

Route::group([
    'middleware' => 'api',
    'prefix' => 'recertconstancia'

], function ($router) {
    Route::resource('/', 'RecertConstanciaController');
    Route::post('upload/', 'RecertConstanciaController@update');
    Route::put('update/{id}', 'RecertConstanciaController@update');
    Route::post('create/', 'RecertConstanciaController@store');
    Route::delete('delete/{id}', 'RecertConstanciaController@destroy');
    Route::get('file/{filename}', 'RecertConstanciaController@getFilePdf');
    Route::get('user/{id}', 'RecertConstanciaController@getRecertConstanciaByUser');

  
});

//Rutas del controlador de Recertificacion-Certificados

Route::group([
    'middleware' => 'api',
    'prefix' => 'recertcertificado'

], function ($router) {
    Route::resource('/', 'RecertCertificadoController');
    Route::put('upload/', 'RecertCertificadoController@update');
    Route::put('update/{id}', 'RecertCertificadoController@update');
    Route::post('create/', 'RecertCertificadoController@store');
    Route::delete('delete/{id}', 'RecertCertificadoController@destroy');
    Route::get('file/{filename}', 'RecertCertificadoController@getFilePdf');
    Route::get('user/{id}', 'RecertCertificadoController@getRecertificadoByUser');

  
});

//Rutas del controlador de Recertificacion-Conferencias y afiliaciones

Route::group([
    'middleware' => 'api',
    'prefix' => 'recertconferencia'

], function ($router) {
    Route::resource('/', 'RecertConferenciaController');
    Route::put('upload/', 'RecertConferenciaController@update');
    Route::post('create/', 'RecertConferenciaController@store');
    Route::delete('delete/{id}', 'RecertConferenciaController@destroy');
    Route::get('file/{filename}', 'RecertConferenciaController@getFilePdf');
    Route::get('user/{id}', 'RecertConferenciaController@getRecertConferenciaByUser');

  
});

//Rutas del controlador del userpost como entradas

Route::group([
    'middleware' => 'api',
    'prefix' => 'userpost'

], function ($router) {
    Route::resource('/', 'UserPostController');
    Route::put('update/{id}', 'UserPostController@update');
    Route::post('create/', 'UserPostController@store');
    Route::delete('delete/{id}', 'UserPostController@destroy');
    Route::get('show/{id}', 'UserPostController@show');
    Route::get('user/{id}', 'UserPostController@getPostsByUser');
    Route::get('image/{filename}', 'UserPostController@getImage');
    Route::get('user/{id}', 'UserPostController@getPostsByUser');
    Route::get('estados/', 'UserPostController@getEstados');
    Route::get('tiporegistro/{id}', 'UserPostController@getUserPostsByTipoRegistro');
    Route::get('tiporegistro/users/{id}', 'UserPostController@tiporegistroUsers');

});

//Rutas del controlador de tipo registro

Route::group([
    'middleware' => 'api',
    'prefix' => 'tiporegistro'

], function ($router) {
    Route::resource('/', 'TipoRegistroController');
    Route::post('store/', 'TipoRegistroController@store');
    Route::get('users/{id}','TipoRegistroController@userstipo');
    Route::get('detail/{id}','TipoRegistroController@detail');
    //Route::resource('{id}', 'TipoRegistroController');

});

//Rutas del controlador de tipo status

Route::group([
    'middleware' => 'api',
    'prefix' => 'estado'

], function ($router) {
    Route::resource('/', 'EstadoController');
    Route::post('store/', 'EstadoController@store');
    Route::get('users/{id}','EstadoController@userstipo');
    Route::get('detail/{id}','EstadoController@detail');


// Route::resource('/api/estado/{id}', 'EstadoController');

});
