<?php

Route::get('/', 'UsersController@login')->name('login');
Route::get('admin', 'UsersController@login');
Route::get('logout', 'Auth\LoginController@logout');

Auth::routes();

Route::get('login', 'UsersController@login');
Route::get('setup', 'IntegrationController@index');
Route::get('setup/excel', 'IntegrationController@excel');

Route::group(['middleware' => ['auth', 'csrf']], function () {
    
    Route::get('/dashboard', 'HomeController@index');
    Route::get('/importData', 'HomeController@importData');
    Route::post('/importData', 'HomeController@importDataStore');

    Route::get('/profitability', 'HomeController@profitability');
    Route::get('/asset', 'HomeController@asset');
    Route::get('/leverage', 'HomeController@leverage'); 

    Route::get('subscriptions', 'HomeController@subscriptions');
    Route::post('withStripe', 'PlansController@withStripe');
    
    Route::get('profile', 'UsersController@profileAuth');
    Route::post('updateCostumer', 'UsersController@updateCostumer');

    Route::get('api_key', 'HomeController@integrations');
    Route::post('configurations/env', 'HomeController@env');
    Route::get('configurations', 'HomeController@configurations');
    Route::get('configurations/edit', 'HomeController@editConfigurations');
    Route::post('configurations/updateConfigurations', 'HomeController@updateConfigurations');

    Route::get('test', 'HomeController@test');

    Route::group(['prefix' => 'users',], function () {
        Route::get('/', 'UsersController@index')->name('users.user.index');
        Route::get('/create', 'UsersController@create')->name('users.user.create');
        Route::get('/show/{user}', 'UsersController@show')->name('users.user.show')->where('id', '[0-9]+');
        Route::get('/{user}/edit', 'UsersController@edit')->name('users.user.edit')->where('id', '[0-9]+');
        Route::post('/', 'UsersController@store')->name('users.user.store');
        Route::put('user/{user}', 'UsersController@update')->name('users.user.update')->where('id', '[0-9]+');
        Route::delete('/user/{user}', 'UsersController@destroy')->name('users.user.destroy')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'plans',], function () {
        Route::get('/', 'PlansController@index')->name('plans.plan.index');
        Route::get('/create','PlansController@create')->name('plans.plan.create');
        Route::get('/show/{plan}','PlansController@show')->name('plans.plan.show')->where('id', '[0-9]+');
        Route::get('/{plan}/edit','PlansController@edit')->name('plans.plan.edit')->where('id', '[0-9]+');
        Route::post('/', 'PlansController@store')->name('plans.plan.store');
        Route::put('plan/{plan}', 'PlansController@update')->name('plans.plan.update')->where('id', '[0-9]+');
        Route::delete('/plan/{plan}','PlansController@destroy')->name('plans.plan.destroy')->where('id', '[0-9]+');
    });

});
