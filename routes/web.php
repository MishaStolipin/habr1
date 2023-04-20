<?php

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


Route::get('/', function (){return view('welcome');});

Route::group(['prefix' => 'blog'], function (){
    Route::apiResource('posts', \App\Http\Controllers\Blog\PostController::class)->names('blog.post');
});

Route::apiResource('rest', \App\Http\Controllers\RestController::class)->names('restTest');

//
//Route::get('/', function () {
//
//
//    return view('welcome');
//});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
