<?php

use GuzzleHttp\Psr7\Request;
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

Route::get('/taskOne', 'taskOneController@Home');
Route::get('/taskTwo', 'taskTwoController@Home');
Route::post('/addPasta', 'taskOneController@addPasta');
Route::get('/taskOne/{hash}', 'taskOneController@hash');

Route::post('/login', 'avtorizationController@login');
Route::get('/loginView', 'avtorizationController@loginView');

Route::post('/registration', 'avtorizationController@registration');
Route::get('/registrationView', 'avtorizationController@registrationView');

Route::get('/loginExit', 'avtorizationController@loginExit');


