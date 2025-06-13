<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ScheduleController;

// Authentication Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');

    // Course Routes
    Route::get('/course', [CourseController::class, 'index'])->name('course');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    Route::post('/courses/join', [CourseController::class, 'join'])->name('courses.join');

    // Course Materials Routes
    Route::get('/courses/{course}/materials', [CourseController::class, 'materials'])->name('courses.materials.index');
    Route::get('/courses/{course}/materials/{material}', [CourseController::class, 'showMaterial'])->name('courses.materials.show');
    Route::post('/courses/{course}/materials', [CourseController::class, 'storeMaterial'])->name('courses.materials.store');
    Route::delete('/courses/{course}/materials/{material}', [CourseController::class, 'destroyMaterial'])->name('courses.materials.destroy');
    Route::put('/courses/{course}/materials/{material}', [CourseController::class, 'updateMaterial'])->name('courses.materials.update');
    Route::get('/courses/{course}/materials', [CourseController::class, 'showAllMaterials'])->name('courses.materials.all');

    // Course Attendance Routes
    Route::post('/courses/{course}/attendance', [CourseController::class, 'storeAttendance'])->name('courses.attendance.store');
    Route::get('/courses/{course}/attendance/{attendance}', [CourseController::class, 'showAttendance'])->name('courses.attendance.show');
    Route::post('/courses/{course}/attendance/{attendance}/submit', [CourseController::class, 'submitAttendance'])->name('courses.attendance.submit');
    Route::put('/courses/{course}/attendance/{attendance}/submission/{submission}', [CourseController::class, 'updateAttendanceStatus'])->name('courses.attendance.update-status');
    Route::get('/courses/{course}/attendance', [CourseController::class, 'attendance'])->name('courses.attendance.all');

    // Course Assignment Routes
    Route::post('/courses/{course}/assignments', [CourseController::class, 'storeAssignment'])->name('courses.assignments.store');
    Route::get('/courses/{course}/assignments/{assignment}', [CourseController::class, 'showAssignment'])->name('courses.assignments.show');
    Route::post('/courses/{course}/assignments/{assignment}/submit', [CourseController::class, 'submitAssignment'])->name('courses.assignments.submit');
    Route::put('/courses/{course}/assignments/{assignment}/submissions/{submission}/grade', [CourseController::class, 'gradeAssignment'])->name('courses.assignments.grade');
    Route::get('/courses/{course}/assignments', [CourseController::class, 'showAllAssignments'])->name('courses.assignments.all');
    Route::delete('/courses/{course}/assignments/{assignment}', [CourseController::class, 'destroyAssignment'])->name('courses.assignments.destroy');
    Route::put('/courses/{course}/assignments/{assignment}', [CourseController::class, 'updateAssignment'])->name('courses.assignments.update');

    Route::get('/presence', function () {
        return view('presence.presence');
    })->name('presence');

    Route::get('/resources', function () {
        return view('resources.resources');
    })->name('resources');

    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');

    Route::get('/students', function () {
        return view('students.students');
    })->name('students');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile/delete', [ProfileController::class, 'deleteAccount'])->name('profile.delete');

    // Course Items Routes
    Route::get('/courses/{course}/items/all', [CourseController::class, 'showAllItems'])->name('courses.items.all');
});
