<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

//No requieren Auth
$api->version('v1', ['namespace' => 'App\Http\Controllers'], function ($api) {
    $api->post('aplicacion_login', 'AppController@login');
    $api->post('aplicacion_validacion', 'AppController@validacion');
    $api->post('aplicacion_token', 'AppController@getToken');
    $api->post('aplicacion_verificar', 'AppController@verificar');
    $api->post('aplicacion_verificar_email', 'AppController@verificar_email');
    $api->post('aplicacion_registro', 'AppController@registro');
    $api->post('aplicacion_notificaciones', 'AppController@getNotificaciones');
    $api->post('aplicacion_recuperarClave', 'AppController@recuperarClave');
    $api->post('aplicacion_cambiarClave', 'AppController@setClave');
});
