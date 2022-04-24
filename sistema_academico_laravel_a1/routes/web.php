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
Auth::routes(['verify'=>true]);

Route::apiResources([
    'alumno'=>Alumnos::class,   
]);

Route::apiResources([
    'inscripcion'=>Inscripcions::class,   
]);

Route::get('/', function () {
    return view('home');
});

Route::get('/condiciones', function () {
    return view('condiciones');
});


Route::get('/home', 'HomeController@index')->name('home');
