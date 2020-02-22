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
	echo 'aaa';
    return $router->app->version();
});

Route::get('prepare-team', ['as' => 'prepare.team', 'uses' => 'TeamupController@prepareTeam']);
Route::post('set-team', ['as' => 'handle.set.team', 'uses' => 'TeamupController@arrangeTeamWeeks']);