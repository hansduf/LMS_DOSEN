<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');

    Route::get('/course', function () {
        return view('course.course');
    })->name('course');

    Route::get('/presence', function () {
        return view('presence.presence');
    })->name('presence');

    Route::get('/resources', function () {
        return view('resources.resources');
    })->name('resources');

    Route::get('/schedule', function () {
        return view('schedule.schedule');
    })->name('schedule');

    Route::get('/students', function () {
        return view('students.students');
    })->name('students');

    Route::get('/profile', function () {
        return view('profile.profile');
    })->name('profile');
});
