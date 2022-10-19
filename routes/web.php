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

// Route tanpa view
Route::get('/hello', function () {
    return "Hello World";
});

// Membuat route yang menampilkan view 
Route::get('/about', function () {
    return view('about');
});

// Membuat route yang menampilkan view dan mengirim data dari route
Route::get('/favoritequote', function () {
    return view('favoritequote',[
        "quote" => "Stay Hungry, Stay Foolish",
        "by" => "Steve Jobs"
    ]);
});

