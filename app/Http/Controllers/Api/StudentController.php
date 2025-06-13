<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function getDashboard()
    {
        try {
            $student = Auth::user()->student;
            $enrolledCourses = $student->courses;
            
            // Get statistics
            $totalCourses = $enrolledCourses->count();
            $totalAssignments = 0;
            $completedAssignments = 0;
            $totalAttendance = 0;
            $presentAttendance = 0;
            
            foreach ($enrolledCourses as $course) {
                // Count assignments
                $assignments = $course->assignments;
                $totalAssignments += $assignments->count();
                $completedAssignments += $assignments->whereHas('submissions', function($query) use ($student) {
                    $query->where('student_id', $student->student_id);
                })->count();
                
                // Count attendance
                $attendances = $course->attendances;
                $totalAttendance += $attendances->count();
                $presentAttendance += $attendances->whereHas('submissions', function($query) use ($student) {
                    $query->where('student_id', $student->student_id)
                          ->whereIn('status', ['present', 'late']);
                })->count();
            }
            
            // Calculate percentages
            $assignmentCompletion = $totalAssignments > 0 ? 
                round(($completedAssignments / $totalAssignments) * 100) : 0;
            $attendanceRate = $totalAttendance > 0 ? 
                round(($presentAttendance / $totalAttendance) * 100) : 0;
            
            // Get upcoming assignments
            $upcomingAssignments = Assignment::whereHas('course', function($query) use ($student) {
                $query->whereHas('students', function($q) use ($student) {
                    $q->where('student_id', $student->student_id);
                });
            })
            ->where('due_date', '>', now())
            ->orderBy('due_date')
            ->take(5)
            ->get();
            
            // Get today's classes
            $today = now()->format('l');
            $todayClasses = $enrolledCourses->filter(function($course) use ($today) {
                return $course->schedule_day === $today;
            });

            return response()->json([
                'status' => 'success',
                'data' => [
                    'student' => $student,
                    'statistics' => [
                        'total_courses' => $totalCourses,
                        'assignment_completion' => $assignmentCompletion,
                        'attendance_rate' => $attendanceRate
                    ],
                    'upcoming_assignments' => $upcomingAssignments,
                    'today_classes' => $todayClasses
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getCourses()
    {
        try {
            $student = Auth::user()->student;
            $courses = $student->courses()->with(['teacher', 'materials', 'assignments'])->get();

            return response()->json([
                'status' => 'success',
                'data' => $courses
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function joinCourse(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'course_code' => 'required|string|size:6|exists:courses,course_code'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], 422);
            }

            $course = Course::where('course_code', $request->course_code)->first();
            
            if (!$course->is_active) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This course is not active'
                ], 400);
            }

            if ($course->students()->where('student_id', Auth::user()->student->student_id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You are already enrolled in this course'
                ], 400);
            }

            $course->students()->attach(Auth::user()->student->student_id);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully joined the course',
                'data' => $course
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getAssignments()
    {
        try {
            $student = Auth::user()->student;
            $assignments = Assignment::whereHas('course', function($query) use ($student) {
                $query->whereHas('students', function($q) use ($student) {
                    $q->where('student_id', $student->student_id);
                });
            })
            ->with(['course', 'submissions' => function($query) use ($student) {
                $query->where('student_id', $student->student_id);
            }])
            ->orderBy('due_date')
            ->get();

            return response()->json([
                'status' => 'success',
                'data' => $assignments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function submitAssignment(Request $request, Course $course, Assignment $assignment)
    {
        try {
            $validator = Validator::make($request->all(), [
                'submission_link' => 'required|url'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], 422);
            }

            if ($assignment->due_date < now()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Assignment submission deadline has passed'
                ], 400);
            }

            if ($assignment->submissions()->where('student_id', Auth::user()->student->student_id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You have already submitted this assignment'
                ], 400);
            }

            $submission = $assignment->submissions()->create([
                'student_id' => Auth::user()->student->student_id,
                'submission_link' => $request->submission_link,
                'submitted_at' => now()
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Assignment submitted successfully',
                'data' => $submission
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getAttendance()
    {
        try {
            $student = Auth::user()->student;
            $attendanceRecords = Attendance::whereHas('course', function($query) use ($student) {
                $query->whereHas('students', function($q) use ($student) {
                    $q->where('student_id', $student->student_id);
                });
            })
            ->with(['course', 'submissions' => function($query) use ($student) {
                $query->where('student_id', $student->student_id);
            }])
            ->orderBy('created_at', 'desc')
            ->get();

            return response()->json([
                'status' => 'success',
                'data' => $attendanceRecords
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function submitAttendance(Request $request, Course $course, Attendance $attendance)
    {
        try {
            if ($attendance->submissions()->where('student_id', Auth::user()->student->student_id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You have already submitted attendance for this session'
                ], 400);
            }

            $deadline = $attendance->created_at->addMinutes(30);
            $status = now() > $deadline ? 'late' : 'present';

            $submission = $attendance->submissions()->create([
                'student_id' => Auth::user()->student->student_id,
                'status' => $status,
                'submitted_at' => now()
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Attendance submitted successfully',
                'data' => $submission
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getProfile()
    {
        try {
            /** @var User $user */
            $user = Auth::user();
            $user->load('student');
            
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

            $user->load('student');
            
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

    public function getCourseDetail(Course $course)
    {
        try {
            $student = Auth::user()->student;
            
            // Check if student is enrolled in this course
            if (!$course->students()->where('student_id', $student->student_id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You are not enrolled in this course'
                ], 403);
            }

            $course->load(['teacher', 'materials', 'assignments', 'attendances']);
            
            return response()->json([
                'status' => 'success',
                'data' => $course
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getCourseMaterials(Course $course)
    {
        try {
            $student = Auth::user()->student;
            
            // Check if student is enrolled in this course
            if (!$course->students()->where('student_id', $student->student_id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You are not enrolled in this course'
                ], 403);
            }

            $materials = $course->materials()->orderBy('created_at', 'desc')->get();
            
            return response()->json([
                'status' => 'success',
                'data' => $materials
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getMaterialDetail(Material $material)
    {
        try {
            $student = Auth::user()->student;
            
            // Check if student is enrolled in the course that has this material
            if (!$material->course->students()->where('student_id', $student->student_id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You are not enrolled in this course'
                ], 403);
            }

            return response()->json([
                'status' => 'success',
                'data' => $material
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getAssignmentDetail(Assignment $assignment)
    {
        try {
            $student = Auth::user()->student;
            
            // Check if student is enrolled in the course that has this assignment
            if (!$assignment->course->students()->where('student_id', $student->student_id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You are not enrolled in this course'
                ], 403);
            }

            $assignment->load(['course', 'submissions' => function($query) use ($student) {
                $query->where('student_id', $student->student_id);
            }]);

            return response()->json([
                'status' => 'success',
                'data' => $assignment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getCourseAttendance(Course $course)
    {
        try {
            $student = Auth::user()->student;
            
            // Check if student is enrolled in this course
            if (!$course->students()->where('student_id', $student->student_id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You are not enrolled in this course'
                ], 403);
            }

            $attendance = $course->attendances()
                ->with(['submissions' => function($query) use ($student) {
                    $query->where('student_id', $student->student_id);
                }])
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => $attendance
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 