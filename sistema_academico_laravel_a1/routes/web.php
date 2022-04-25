<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\User;

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

Auth::routes(['verify' => true]);

Route::apiResources([
    'alumno' => Alumnos::class,
]);

Route::apiResources([
    'inscripcion' => Inscripcions::class,
]);

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified']);


Route::get('/gps', function () {
    return view('layouts/gps');
});

Route::get('/condiciones', function () {
    return view('layouts/condiciones');
});



// Google login
Route::get('/login-google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/google-callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

// -----------------------------forget password ------------------------------
Route::get('forget-password', 'App\Http\Controllers\Auth\ForgotPasswordController@getEmail')->name('forget-password');
Route::post('forget-password', 'App\Http\Controllers\Auth\ForgotPasswordController@postEmail')->name('forget-password');

Route::get('reset-password/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@getPassword');
Route::post('reset-password', 'App\Http\Controllers\Auth\ResetPasswordController@updatePassword');

Route::get('/home', 'HomeController@index')->name('home');
