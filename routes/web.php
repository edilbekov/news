<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
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

Route::get('/', [IndexController::class,"welcome"])->name('welcome');
Route::get('/single_page/{id}', [IndexController::class,"select"])->name('single_page');
Route::get('/create_news',[IndexController::class,"create_news"])->name('create_news');
Route::post('/create',[IndexController::class,"create"])->name('create');
Route::get('/select',[IndexController::class,"select"]);
// Route::get('/category',[IndexController::class,"category"]);
Route::get('/contact',[IndexController::class,"contact"]);

Route::get('/sports',[IndexController::class,"category"]);
Route::get('/world',[IndexController::class,"category"]);
Route::get('/business',[IndexController::class,"category"]);
Route::get('/technology',[IndexController::class,"category"]);
