<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    return redirect()->route('login');
});


Route::prefix('/login')->group(function() {
    Route::get('/', [App\Http\Controllers\Auth\PasswordLessController::class, 'index'])->name('login');
    Route::post('/', [App\Http\Controllers\Auth\PasswordLessController::class, 'sendToken'])->name('login.send-token');
    Route::get('/{token}', [App\Http\Controllers\Auth\PasswordLessController::class, 'validateToken'])->name('login.verify-token');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::prefix('/onboarding')->group(function() {
    Route::get('/', [App\Http\Controllers\OnboardingController::class, 'index'])->name('onboarding');
    Route::post('/', [App\Http\Controllers\OnboardingController::class, 'saveName'])->name('onboarding.form');
});

Route::post('/logout', function(){
    Session::flush();
    Auth::logout();
    return redirect()->route('login');
})->name('logout');