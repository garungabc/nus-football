<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::get('prepare-team', ['as' => 'prepare.team', 'uses' => 'TeamupController@prepareTeam']);
Route::post('set-team', ['as' => 'handle.set.team', 'uses' => 'TeamupController@arrangeTeamWeeks']);
Route::post('save-setup-team', ['as' => 'save.setup.team', 'uses' => 'TeamupController@saveTeam']);
Route::get('history', ['as' => 'history.index', 'uses' => 'HistoryController@index']);

Route::get('create-user', ['as' => 'user.create', 'uses' => 'UserController@create']);
Route::post('store-user', ['as' => 'user.store', 'uses' => 'UserController@store']);
