<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Jobs
Route::get('/', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);

//Auth
Route::get('/user/login', [UserController::class, 'index'])->name('login');;
Route::get('/user/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store']);