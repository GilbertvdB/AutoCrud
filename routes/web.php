<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImgController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\AllzController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StuffController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('bootstrap');
});

Route::get('/index', function () {
    return view('index');
});

Route::resource('/tests', TestController::class);
Route::resource('/posts', PostController::class);
Route::resource('/stuffs', StuffController::class);
Route::resource('allzs', AllzController::class);
Route::resource('pics', PicController::class);
Route::resource('imgs', ImgController::class);

Route::get('/form', [FormController::class, 'index'])->name('form.home');
Route::post('/form/store', [FormController::class, 'store'])->name('form.store');
