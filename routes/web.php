<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SubmitController;
use App\Http\Controllers\ResultController;

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
Route::get('/login', [LoginController::class,'show'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login.post');
Route::get('/register', [UserController::class,'create'])->name('register.create');
Route::post('/register', [UserController::class,'store'])->name('register.store');
Route::get('/events/search',[EventController::class,'search'])->name('event.search');
Route::get('/events/{id}',[EventController::class,'show'])->name('event.show');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::middleware('auth')->group(function(){
    Route::get('/mypage',function(){
        return view('mypage');
    })->name('mypage');
    Route::get('/eventcreate', [EventController::class,'create'])->name('event.create');
    Route::post('/eventcreate', [EventController::class,'store'])->name('event.store');
    Route::get('/events/{id}/submit', [SubmitController::class,'create'])->name('event.submit');
    Route::post('/events/{id}/submit', [SubmitController::class,'store'])->name('submit.store');
    Route::post('/events/{id}',[EventController::class,'participate'])->name('event.participate');
    Route::get('/events/{id}/manage', [EventController::class,'manage'])->name('event.manage');
    Route::post('/events/{id}/result',[ResultController::class,'store'])->name('result.store');
    Route::post('/events/{id}/cancel',[EventController::class,'cancel'])->name('event.cancel');
});