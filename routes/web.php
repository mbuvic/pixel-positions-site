<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//Jobs
Route::get('/', [JobController::class, 'index']);
Route::get('/jobs/{slug}', [JobController::class, 'viewJob']);

//User Authentication
Route::get('/user/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/user/login', [UserController::class, 'login']);
Route::get('/user/register', [UserController::class, 'showRegistrationForm']);
Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/logout', [UserController::class, 'logout'])->middleware('auth');

//User Profile Management
Route::get('/user/dashboard', [ProfileController::class, 'showDashboard'])->middleware('auth');
Route::get('/user/my-jobs', [ProfileController::class, 'showMyJobs'])->middleware('auth');
Route::get('/user/my-jobs/edit/{slug}', [ProfileController::class, 'editAJob'])->middleware('auth');
Route::post('/user/my-jobs/edit', [ProfileController::class, 'updateAJob'])->middleware('auth');
Route::get('/user/profile', [ProfileController::class, 'showUser'])->middleware('auth');
Route::post('/user/profile', [ProfileController::class, 'updateUser'])->middleware('auth');
Route::get('/user/company-profile', [ProfileController::class, 'showUserCompany'])->middleware('auth');
Route::post('/user/company-profile', [ProfileController::class, 'updateUserCompany'])->middleware('auth');
Route::get('/user/my-jobs/create', [ProfileController::class, 'showJobCreateForm'])->middleware('auth');
Route::post('/user/my-jobs/create', [ProfileController::class, 'storeJob'])->middleware('auth');