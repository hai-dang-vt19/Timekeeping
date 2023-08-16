<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
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

Auth::routes();

Route::get('/qrcode/{telecom}', [HomeController::class, 'read_qrcode'])->name('read_qrcode');

Route::get('/search', [UserController::class, 'search'])->middleware('can:all')->name('search');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home/destroy/', [HomeController::class, 'destroy_user_calen'])->middleware('can:manager')->name('destroy_user_calen');
Route::get('/home/truncate', [HomeController::class, 'trun_calen'])->middleware('can:manager')->middleware('can:manager')->name('trun_calen');

Route::get('/group', [GroupController::class, 'index_group'])->name('index_group');
Route::post('/group/create', [GroupController::class, 'create_group'])->middleware('can:manager')->name('create_group');
Route::get('/group/destroy', [GroupController::class, 'destroy_group'])->middleware('can:manager')->name('destroy_group');

Route::get('/user', [UserController::class, 'index_user'])->name('index_user');
Route::post('/user/create', [UserController::class, 'create_user'])->middleware('can:manager')->name('create_user');
Route::post('/user/update', [UserController::class, 'update_user'])->name('update_user');
Route::get('/user/destroy/', [UserController::class,'destroy_user'])->middleware('can:manager')->name('destroy_user');