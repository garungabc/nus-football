<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('components.dashboard.dashboard');
})->name('dashboard');

Route::prefix('team')->group(function () {
    Route::get('prepare', ['as' => 'prepare.team', 'uses' => 'TeamupController@prepareTeam']);
    Route::post('organize', ['as' => 'handle.set.team', 'uses' => 'TeamupController@arrangeTeamWeeks']);
    Route::post('save-setup', ['as' => 'save.setup.team', 'uses' => 'TeamupController@saveTeam']);
});
Route::get('history', ['as' => 'history.index', 'uses' => 'HistoryController@index']);

Route::prefix('users')->group(function () {
    Route::get('/', ['as' => 'user.index', 'uses' => 'UserController@index']);
    Route::get('create', ['as' => 'user.create', 'uses' => 'UserController@create']);
    Route::post('store', ['as' => 'user.store', 'uses' => 'UserController@store']);
    Route::get('delete', ['as' => 'user.delete', 'uses' => 'UserController@delete']);
    Route::post('destroy', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);
});
