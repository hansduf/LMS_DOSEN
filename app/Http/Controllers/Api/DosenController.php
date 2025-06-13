<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Attendance;
use App\Models\Assignment;
use App\Models\Material;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    // Course Management
    public function getCourses()
    {
        $courses = Course::with(['teacher', 'students'])->get();
        return response()->json([
            'status' => 'success',
            'data' => $courses
        ]);
    }

    public function createCourse(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:courses',
            'description' => 'required|string',
            'semester' => 'required|string',
            'academic_year' => 'required|string'
        ]);

        $course = Course::create($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Course created successfully',
            'data' => $course
        ]);
    }

    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $validated = $request->validate([
            'name' => 'string|max:255',
            'code' => 'string|max:50|unique:courses,code,' . $id,
            'description' => 'string',
            'semester' => 'string',
            'academic_year' => 'string'
        ]);

        $course->update($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Course updated successfully',
            'data' => $course
        ]);
    }

    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Course deleted successfully'
        ]);
    }

    // Material Management
    public function getMaterials($courseId)
    {
        $materials = Material::where('course_id', $courseId)->get();
        return response()->json([
            'status' => 'success',
            'data' => $materials
        ]);
    }

    public function createMaterial(Request $request, $courseId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|max:10240' // max 10MB
        ]);

        $file = $request->file('file');
        $path = $file->store('materials');

        $material = Material::create([
            'course_id' => $courseId,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $path
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Material created successfully',
            'data' => $material
        ]);
    }

    // Assignment Management
    public function getAssignments($courseId)
    {
        $assignments = Assignment::where('course_id', $courseId)->get();
        return response()->json([
            'status' => 'success',
            'data' => $assignments
        ]);
    }

    public function createAssignment(Request $request, $courseId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'attachment_link' => 'nullable|url'
        ]);

        $assignment = Assignment::create([
            'course_id' => $courseId,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
            'attachment_link' => $validated['attachment_link'] ?? null
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Assignment created successfully',
            'data' => $assignment
        ]);
    }

    // Attendance Management
    public function getAttendance($courseId)
    {
        $attendance = Attendance::where('course_id', $courseId)
            ->with(['students'])
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => $attendance
        ]);
    }

    public function createAttendance(Request $request, $courseId)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'description' => 'required|string'
        ]);

        $attendance = Attendance::create([
            'course_id' => $courseId,
            'date' => $validated['date'],
            'description' => $validated['description']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance session created successfully',
            'data' => $attendance
        ]);
    }

    // Profile Management
    public function getProfile()
    {
        try {
            /** @var User $user */
            $user = Auth::user();
            $user->load('teacher');
            
            return response()->json([
                'status' => 'success',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            /** @var User $user */
            $user = Auth::user();
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'current_password' => 'required_with:new_password|current_password',
                'new_password' => 'nullable|min:8|confirmed'
            ]);

            $user->fill([
                'name' => $validated['name'],
                'email' => $validated['email']
            ])->save();

            if (isset($validated['new_password'])) {
                $user->fill([
                    'password' => bcrypt($validated['new_password'])
                ])->save();
            }

            $user->load('teacher');
            
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 