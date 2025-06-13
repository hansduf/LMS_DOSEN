<?php

// Debug statement
file_put_contents(storage_path('logs/api_routes.log'), 'API routes file loaded at ' . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\DosenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Test routes - no auth required
Route::get('test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API is working!'
    ]);
});

Route::get('test/connection', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API connection is working!'
    ]);
});

Route::get('test/courses', function () {
    return response()->json([
        'status' => 'success',
        'data' => [
            [
                'id' => 1,
                'code' => 'CS101',
                'name' => 'Introduction to Programming',
                'description' => 'Basic programming concepts'
            ],
            [
                'id' => 2,
                'code' => 'CS102',
                'name' => 'Data Structures',
                'description' => 'Advanced programming concepts'
            ]
        ]
    ]);
});

// --- ENDPOINT TANPA LOGIN UNTUK TESTING ---
Route::post('attendance/submit', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Attendance submitted successfully',
        'data' => [
            'student_id' => request('student_id'),
            'course_id' => request('course_id'),
            'status' => 'present',
            'submitted_at' => now()
        ]
    ]);
});

Route::post('courses/join', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Successfully joined course',
        'data' => [
            'student_id' => request('student_id'),
            'course_id' => request('course_id'),
            'joined_at' => now()
        ]
    ]);
});

Route::post('assignments/{assignment}/submit', function ($assignment) {
    return response()->json([
        'status' => 'success',
        'message' => 'Assignment submitted successfully',
        'data' => [
            'student_id' => request('student_id'),
            'assignment_id' => $assignment,
            'submission' => request('submission'),
            'submitted_at' => now()
        ]
    ]);
});

// Auth routes - no auth required
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Student routes
    Route::prefix('student')->group(function () {
        // Dashboard
        Route::get('/dashboard', [StudentController::class, 'getDashboard']);
        
        // Course Management
        Route::get('/courses', [StudentController::class, 'getCourses']);
        Route::get('/courses/{course}', [StudentController::class, 'getCourseDetail']);
        Route::post('/courses/join', [StudentController::class, 'joinCourse']);
        
        // Material Management
        Route::get('/courses/{course}/materials', [StudentController::class, 'getCourseMaterials']);
        Route::get('/materials/{material}', [StudentController::class, 'getMaterialDetail']);
        
        // Assignment Management
        Route::get('/assignments', [StudentController::class, 'getAssignments']);
        Route::get('/assignments/{assignment}', [StudentController::class, 'getAssignmentDetail']);
        Route::post('/assignments/{assignment}/submit', [StudentController::class, 'submitAssignment']);
        
        // Attendance Management
        Route::get('/attendance', [StudentController::class, 'getAttendance']);
        Route::get('/courses/{course}/attendance', [StudentController::class, 'getCourseAttendance']);
        Route::post('/attendance/submit', [StudentController::class, 'submitAttendance']);
        
        // Profile Management
        Route::get('/profile', [StudentController::class, 'getProfile']);
        Route::put('/profile', [StudentController::class, 'updateProfile']);
    });

    // Dosen routes
    Route::prefix('dosen')->group(function () {
        // Course Management
        Route::get('/courses', [DosenController::class, 'getCourses']);
        Route::post('/courses', [DosenController::class, 'createCourse']);
        Route::put('/courses/{id}', [DosenController::class, 'updateCourse']);
        Route::delete('/courses/{id}', [DosenController::class, 'deleteCourse']);

        // Material Management
        Route::get('/courses/{courseId}/materials', [DosenController::class, 'getMaterials']);
        Route::post('/courses/{courseId}/materials', [DosenController::class, 'createMaterial']);

        // Assignment Management
        Route::get('/courses/{courseId}/assignments', [DosenController::class, 'getAssignments']);
        Route::post('/courses/{courseId}/assignments', [DosenController::class, 'createAssignment']);

        // Attendance Management
        Route::get('/courses/{courseId}/attendance', [DosenController::class, 'getAttendance']);
        Route::post('/courses/{courseId}/attendance', [DosenController::class, 'createAttendance']);

        // Profile Management
        Route::get('/profile', [DosenController::class, 'getProfile']);
        Route::put('/profile', [DosenController::class, 'updateProfile']);
    });
}); 