<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('contractor', 'ContractorController@index');

Route::get('administrator', 'AdministratorController@index');

Route::get('developer', 'DeveloperController@index');
Route::get('database', 'DatabaseController@index');

Route::get('account', 'AccountController@index');
Route::post('account/reset/all', 'AccountController@resetAllUserPass');
Route::get('account/reset/all/export', 'AccountController@exportNewUserPass');

Route::get('resources', 'ResourcesController@index');
Route::get('resources/summary/wk/{working_area_id}',
    'ResourcesController@summaryWorkingArea');