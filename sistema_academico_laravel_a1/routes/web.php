<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
Auth::routes(['verify'=>true]);

Route::apiResources([
    'alumno'=>Alumnos::class,   
]);

Route::apiResources([
    'inscripcion'=>Inscripcions::class,   
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

Route::get('/login-google', function () {
    return Socialite::driver('github')->redirect();
});
 
Route::get('/google-callback', function () {
    $user = Socialite::driver('github')->user();
 
    // $user->token
});

Route::get('/home', 'HomeController@index')->name('home');
