<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//dd(Auth::user());

//Jobs
Route::get('/', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::post('/jobs/create', [JobController::class, 'store'])->middleware('auth');

//Auth
Route::get('/user/login', [UserController::class, 'index'])->name('login');;
Route::get('/user/register', [UserController::class, 'create']);
Route::post('/user/login', [UserController::class, 'setSession']);
Route::post('/user/register', [UserController::class, 'store']);
Route::post('/user/logout', [UserController::class, 'destroySession'])->middleware('auth');