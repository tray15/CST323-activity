<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CrudController;

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
    return view('login');
});

//Login Controller routing
Route::get('/home', [LoginController::class], 'home');
Route::get('/login', function () {
    return view('login');
});
Route::post('/dologin', [LoginController::class, 'index']);
Route::view('/allUsers', [LoginController::class, 'allUsers']);

//Registration routing
Route::get('/register', function () {
    return view('register');
});
Route::post('/doRegister', [RegisterController::class, 'saveUser']);

//Crud routing
Route::get('/allUsers', [CrudController::class, 'index']);
Route::delete('/allUsers/deleteUser/{id}', [CrudController::class, 'delete']);
Route::get('/allUsers/editUser/{id}', [CrudController::class, 'edit']);
Route::put('allUsers/doUserUpdate/{id}', [CrudController::class, 'doUserUpdate']);            