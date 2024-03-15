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

Route::get('/', ['App\Http\Controllers\HomeController', 'index']);
Route::post('/user/store', ['App\Http\Controllers\UserController', 'store'])->name('user.store');
Route::get('/freespins/{link}', ['App\Http\Controllers\FreespinsController', 'index'])->name('freespins')->middleware('verify.link');
Route::post('/freespins/store', ['App\Http\Controllers\FreespinsController', 'store'])->name('freespins.store');
Route::delete('/freespins/deactivateLink/{link}', ['App\Http\Controllers\FreespinsController', 'deactivateLink'])->name('freespins.deactivateLink');
Route::delete('/freespins/generateNewLink/{link}', ['App\Http\Controllers\FreespinsController', 'generateNewLink'])->name('freespins.generateNewLink');
