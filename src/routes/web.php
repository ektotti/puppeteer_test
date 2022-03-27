<?php

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

use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TestNameController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'test']);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/{provider}', [LoginController::class, 'redirectToGoogle'] );
Route::get('/login/{provider}/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('/testname', [TestNameController::class, 'create']);
Route::post('/testname', [TestNameController::class, 'store']);