<?php

use App\Http\Controllers\ExtraController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\Test2Controller;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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

Route::get('/form', [FormController::class, 'index'])->name('form.home');
Route::post('/form/store', [FormController::class, 'store'])->name('form.store');

Route::resource('/'.'extras', ExtraController::class);
Route::resource('/'.'tests', TestController::class);

Route::resource('/'.'test2s', Test2Controller::class);
Route::resource('/'.'contests', ContestController::class);