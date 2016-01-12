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

Route::group(['prefix' => 'play', 'middleware' => 'auth'], function() {
    Route::get('/', 'PlayController@index');
    Route::get('create', 'PlayController@create');
    Route::post('/', 'PlayController@store');
    Route::get('{id}', 'PlayController@show');
    Route::get('{id}/edit', 'PlayController@edit');
    Route::put('{id}', 'PlayController@update');
    Route::post('destroy', 'PlayController@destroy');
    Route::post('child', 'PlayController@findLeadProspect');
});

Route::group(['prefix' => 'lead', 'middleware' => 'auth'], function() {
    Route::get('/', 'LeadController@index');
    Route::get('create', 'LeadController@create');
    Route::post('/', 'LeadController@store');
    Route::get('{id}', 'LeadController@show');
    Route::get('{id}/edit', 'LeadController@edit');
    Route::put('{id}', 'LeadController@update');
    Route::post('destroy', 'LeadController@destroy');
    Route::post('gcf', 'LeadController@getPlayGcf');
});

Route::get('administrator', 'AdministratorController@index');

Route::get('developer', 'DeveloperController@index');
Route::get('database', 'DatabaseController@index');

Route::get('account', 'AccountController@index');
Route::post('account/reset/all', 'AccountController@resetAllUserPass');
Route::get('account/reset/all/export', 'AccountController@exportNewUserPass');

Route::get('resources', 'ResourcesController@index');
Route::get('resources/summary/wk/{workingAreaId}',
    'ResourcesController@summaryWorkingArea');

Route::get('system/year', 'SystemController@year');
