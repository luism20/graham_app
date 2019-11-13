<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

//No requieren Auth
$api->version('v1', ['namespace' => 'App\Http\Controllers', 'middleware' => 'api.auth'], function ($api) {

});
