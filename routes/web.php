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
    return view('welcome');
});


Route::get('/login', [App\Http\Controllers\Auth\PasswordLessController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\PasswordLessController::class, 'sendToken'])->name('login.send-token');
Route::get('/login/{token}', [App\Http\Controllers\Auth\PasswordLessController::class, 'validateToken'])->name('login.verify-token');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
