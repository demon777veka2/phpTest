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

Route::get('/', 'TaskOne\taskOneController@Home');
Route::get('/taskOne', 'TaskOne\taskOneController@Home');
Route::get('/taskTwo', 'TaskTwo\taskTwoController@Home');
Route::post('/addPasta', 'TaskOne\taskOneController@addPasta');
Route::get('/taskOne/{hash}', 'TaskOne\taskOneController@hash');

Route::post('/login', 'TaskOne\avtorizationController@login');
Route::get('/loginView', 'TaskOne\avtorizationController@loginView');

Route::post('/registration', 'TaskOne\avtorizationController@registration');
Route::get('/registrationView', 'TaskOne\avtorizationController@registrationView');

Route::get('/loginExit', 'TaskOne\avtorizationController@loginExit');
