<?php

Route::group(['middleware' => ['auth'], 'prefix' => 'webapi'], function () {
    Route::post('getRutasEspecificas', 'WebApiController@getRutasEspecificas');
    Route::post('getPresupuesto', 'WebApiController@getPresupuesto');
    Route::post('getSedes', 'WebApiController@getSedes');

    Route::post('aceptarFotosRemesa', 'ViajesController@aceptarFotosRemesa');
    Route::post('rechazarFotosRemesa', 'ViajesController@rechazarFotosRemesa');
    
    Route::post('rechazarGasto', 'WebApiController@rechazarGasto');
    
    Route::post('contabilizarViaje', 'ViajesController@aContabilizar');
    Route::post('finalizarViaje', 'ViajesController@aFinalizar');
    
    Route::post('notificaciones_web', 'HomeController@notificacionesWeb');
});

Route::group(['middleware' => ['auth']], function () {

    //peticiones Ajax web

    Route::post('nuevoRol', 'HomeController@nuevoRol');

});
