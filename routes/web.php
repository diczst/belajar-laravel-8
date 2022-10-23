<?php

use App\Http\Controllers\BookController;
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

Route::get('/home', function () {
    return view('home',['title' => 'Halaman Utama']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Kontak Saya']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'Tentang Saya']);
});