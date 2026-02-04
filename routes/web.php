<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeanController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('account', [UserController::class, 'edit'])->name('account');
    Route::post('account', [UserController::class, 'update']);
    Route::put('account', [AuthController::class, 'update']);

    Route::get('dean', [DeanController::class, 'index'])->name('dean');
    Route::post('dean', [DeanController::class, 'update']);

    Route::get('faculties', [FacultyController::class, 'index'])->name('faculties');

    Route::get('profile', [StudentController::class, 'index'])->name('profile');
    Route::post('profile', [StudentController::class, 'storeUpdate']);

    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [UserController::class, 'create'])->name('register');

    Route::post('login', [AuthController::class, 'connect']);
    Route::post('register', [UserController::class, 'store']);
});
