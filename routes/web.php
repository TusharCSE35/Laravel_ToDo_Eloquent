<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

// Login Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Routes for authenticated users
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
Route::post('/settings/update-profile', [DashboardController::class, 'updateProfile'])->name('settings.updateProfile');

// Routes for task
Route::get('/tasks', [TaskController::class, 'home'])->name('tasks');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');