<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//Jobs
Route::get('/', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::post('/jobs/create', [JobController::class, 'store'])->middleware('auth');

//User Authentication
Route::get('/user/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/user/login', [UserController::class, 'login']);
Route::get('/user/register', [UserController::class, 'showRegistrationForm']);
Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/logout', [UserController::class, 'logout'])->middleware('auth');

//User Profile Management
Route::get('/user/profile', [ProfileController::class, 'showUser'])->middleware('auth');
Route::post('/user/profile', [ProfileController::class, 'updateUser'])->middleware('auth');
Route::get('/user/company-profile', [ProfileController::class, 'showUserCompany'])->middleware('auth');
Route::post('/user/company-profile', [ProfileController::class, 'updateUserCompany'])->middleware('auth');