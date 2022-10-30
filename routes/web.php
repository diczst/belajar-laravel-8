<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\KategoriController;
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
Route::get('/',[BookController::class, 'index']);

Route::get('/buku/edit/{param}',[BookController::class, 'edit']);
Route::post('/buku/update', [BookController::class, 'update']);

Route::post('/buku/store',[BookController::class, 'store']);
Route::get('/buku/destroy/{param}', [BookController::class, 'destroy']);

Route::get('/buku/search', [BookController::class, 'search']);

Route::get('/kategori',[KategoriController::class, 'index']);

Route::post('/kategori/store',[KategoriController::class, 'store']);

Route::get('/kategori/edit/{param}',[KategoriController::class, 'edit']);
Route::post('/kategori/update', [KategoriController::class, 'update']);
Route::get('/kategori/destroy/{param}', [KategoriController::class, 'destroy']);





