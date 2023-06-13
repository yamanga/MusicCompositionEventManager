<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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
    return view('top');
})->name('top');
Route::get('login', [LoginController::class,'show'])->name('login');
Route::post('login',[LoginController::class,'login'])->name('login.post');
Route::get('register', [UserController::class,'create'])->name('register.create');
Route::post('register', [UserController::class,'store'])->name('register.store');
