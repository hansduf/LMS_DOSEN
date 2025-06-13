<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Material;
use App\Models\Attendance;
use App\Models\AttendanceSubmission;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $teacher = Auth::user()->teacher;
        $courses = Course::where('teacher_id', $teacher->teacher_id)->get();
        
        return view('course.course', compact('courses'));
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'semester' => 'required|integer|between:1,8',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'class_color' => 'required|string|in:blue-400,blue-500,blue-600,blue-700,green-400,green-500,green-600,green-700,purple-400,purple-500,purple-600,purple-700,pink-400,pink-500,pink-600,pink-700',
            'schedule_day' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'sks' => 'required|integer|in:1,2,3,4',
            'location' => 'required|string|max:255'
        ]);

        $course = new Course();
        $course->teacher_id = Auth::user()->teacher->teacher_id;
        $course->course_code = $course->generateCourseCode();
        $course->title = $request->title;
        $course->semester = $request->semester;
        $course->description = $request->description;
        $course->class_color = $request->class_color;
        $course->schedule_day = $request->schedule_day;
        $course->start_time = $request->start_time;
        $course->sks = $request->sks;
        $course->location = $request->location;

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('course-thumbnails', 'public');
            $course->thumbnail = $path;
        }

        $course->save();

        return redirect()->route('course')
            ->with('success', 'Class created successfully! Class Code: ' . $course->course_code);
    }

    public function show(Course $course)
    {
        $this->authorize('view', $course);
        
        $lessons = $course->lessons;
        $students = $course->students;
        $attendances = $course->attendances;
        $materials = $course->materials()->latest()->get();
        $assignments = $course->assignments()->latest()->get();

        // Gabungkan materi dan tugas
        $combinedItems = collect();
        
        // Tambahkan materi
        foreach ($materials as $material) {
            $combinedItems->push([
                'type' => 'material',
                'data' => $material,
                'created_at' => $material->created_at
            ]);
        }
        
        // Tambahkan tugas
        foreach ($assignments as $assignment) {
            $combinedItems->push([
                'type' => 'assignment',
                'data' => $assignment,
                'created_at' => $assignment->created_at
            ]);
        }
        
        // Ambil 2 item terbaru
        $latestItems = $combinedItems->sortByDesc('created_at')->take(2);
        
        $showAll = request('show') === 'all';
        $showAllAttendance = request('show') === 'all_attendance';
        
        return view('course.show', compact(
            'course', 
            'lessons', 
            'students', 
            'latestItems', 
            'attendances', 
            'materials', 
            'assignments',
            'showAll',
            'showAllAttendance'
        ));
    }

    public function showAllItems(Course $course)
    {
        $this->authorize('view', $course);
        
        $lessons = $course->lessons;
        $students = $course->students;
        $attendances = $course->attendances;
        $materials = $course->materials()->latest()->get();
        $assignments = $course->assignments()->latest()->get();
        
        $allItems = collect();
        
        foreach ($materials as $material) {
            $allItems->push([
                'type' => 'material',
                'data' => $material,
                'created_at' => $material->created_at
            ]);
        }
        
        foreach ($assignments as $assignment) {
            $allItems->push([
                'type' => 'assignment',
                'data' => $assignment,
                'created_at' => $assignment->created_at
            ]);
        }
        
        $allItems = $allItems->sortByDesc('created_at');
        
        return view('course.show', [
            'course' => $course,
            'lessons' => $lessons,
            'students' => $students,
            'attendances' => $attendances,
            'materials' => $materials,
            'assignments' => $assignments,
            'latestItems' => $allItems,
            'showAll' => true,
            'showAllAttendance' => false
        ]);
    }

    public function showAllMaterials(Course $course)
    {
        $this->authorize('view', $course);
        
        $materials = $course->materials()->latest()->get();
        return view('course.materials', compact('course', 'materials'));
    }

    public function showAllAssignments(Course $course)
    {
        $this->authorize('view', $course);
        
        $assignments = $course->assignments()->latest()->get();
        return view('course.assignments', compact('course', 'assignments'));
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        
        return view('course.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $request->validate([
            'title' => 'required|string|max:255',
            'semester' => 'required|integer|between:1,8',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'class_color' => 'required|string|in:blue-400,blue-500,blue-600,blue-700,green-400,green-500,green-600,green-700,purple-400,purple-500,purple-600,purple-700,pink-400,pink-500,pink-600,pink-700',
            'schedule_day' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'sks' => 'required|integer|in:1,2,3,4',
            'location' => 'required|string|max:255'
        ]);

        $course->title = $request->title;
        $course->semester = $request->semester;
        $course->description = $request->description;
        $course->class_color = $request->class_color;
        $course->schedule_day = $request->schedule_day;
        $course->start_time = $request->start_time;
        $course->sks = $request->sks;
        $course->location = $request->location;

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $path = $request->file('thumbnail')->store('course-thumbnails', 'public');
            $course->thumbnail = $path;
        }

        $course->save();

        return redirect()->route('course')->with('success', 'Class updated successfully!');
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return redirect()->route('course')->with('success', 'Class deleted successfully!');
    }

    public function join(Request $request)
    {
        $request->validate([
            'course_code' => 'required|string|size:6|exists:courses,course_code'
        ]);

        $course = Course::where('course_code', $request->course_code)->first();
        
        if (!$course->is_active) {
            return back()->with('error', 'This class is not active.');
        }

        if ($course->students()->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You are already enrolled in this class.');
        }

        $enrollment = new Enrollment();
        $enrollment->user_id = Auth::id();
        $enrollment->course_id = $course->id;
        $enrollment->enrolled_at = now();
        $enrollment->save();

        return redirect()->route('courses.show', $course)->with('success', 'Successfully joined the class!');
    }

    // Material Methods
    public function storeMaterial(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'external_link' => 'nullable|url'
        ]);

        $material = $course->materials()->create([
            'title' => $request->title,
            'description' => $request->description,
            'external_link' => $request->external_link
        ]);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Materi berhasil ditambahkan');
    }

    public function destroyMaterial(Course $course, Material $material)
    {
        $this->authorize('update', $course);

        $material->delete();

        return redirect()->route('courses.show', $course)
            ->with('success', 'Materi berhasil dihapus');
    }

    public function updateMaterial(Request $request, Course $course, Material $material)
    {
        $this->authorize('update', $course);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'external_link' => 'nullable|url'
        ]);

        $material->update([
            'title' => $request->title,
            'description' => $request->description,
            'external_link' => $request->external_link
        ]);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Materi berhasil diperbarui');
    }

    public function showMaterial(Course $course, Material $material)
    {
        // Check if the material belongs to the course
        if ($material->course_id !== $course->id) {
            abort(404);
        }

        return view('course.material', [
            'course' => $course,
            'material' => $material
        ]);
    }

    // Attendance Methods
    public function storeAttendance(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $request->validate([
            'attendance_title' => 'required|string|max:255'
        ]);

        $attendance = $course->attendances()->create([
            'title' => $request->attendance_title
        ]);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Absensi berhasil dibuat');
    }

    public function showAttendance(Course $course, Attendance $attendance)
    {
        $this->authorize('view', $course);

        $submissions = $attendance->submissions()->with('student')->get();
        
        // Check for late submissions
        $deadline = $attendance->created_at->addMinutes(30);
        foreach ($submissions as $submission) {
            if ($submission->created_at > $deadline && $submission->status === 'present') {
                $submission->status = 'late';
                $submission->save();
            }
        }

        return view('course.attendance-detail', compact('course', 'attendance', 'submissions'));
    }

    public function updateAttendanceStatus(Request $request, Course $course, Attendance $attendance, AttendanceSubmission $submission)
    {
        $this->authorize('update', $course);

        $request->validate([
            'status' => 'required|in:present,late,absent'
        ]);

        $submission->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status absensi berhasil diperbarui');
    }

    public function attendance(Course $course)
    {
        $this->authorize('view', $course);
        $attendances = $course->attendances()->orderBy('created_at', 'desc')->get();
        return view('course.attendance', compact('course', 'attendances'));
    }

    // Assignment Methods
    public function storeAssignment(Request $request, Course $course)
    {
        try {
            $this->authorize('update', $course);

            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'due_date' => 'required|date|after:now',
                'attachment_link' => 'nullable|url'
            ]);

            $assignment = $course->assignments()->create([
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'attachment_link' => $request->attachment_link
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tugas berhasil dibuat',
                    'assignment' => $assignment
                ]);
            }

            return redirect()->route('courses.show', $course)
                ->with('success', 'Tugas berhasil dibuat');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }

            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function submitAssignment(Request $request, Course $course, Assignment $assignment)
    {
        $this->authorize('view', $course);

        if ($assignment->due_date < now()) {
            return back()->with('error', 'Batas waktu pengumpulan sudah lewat');
        }

        if ($assignment->submissions()->where('student_id', Auth::id())->exists()) {
            return back()->with('error', 'Anda sudah mengumpulkan tugas ini');
        }

        $request->validate([
            'submission_link' => 'required|url'
        ]);

        $assignment->submissions()->create([
            'student_id' => Auth::id(),
            'submission_link' => $request->submission_link,
            'submitted_at' => now()
        ]);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Tugas berhasil dikumpulkan');
    }

    public function gradeAssignment(Request $request, Course $course, Assignment $assignment, AssignmentSubmission $submission)
    {
        $this->authorize('update', $course);

        $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'feedback' => 'nullable|string'
        ]);

        $submission->update([
            'score' => $request->score,
            'feedback' => $request->feedback
        ]);

        return back()->with('success', 'Nilai berhasil diperbarui');
    }

    public function showAssignment(Course $course, Assignment $assignment)
    {
        $this->authorize('view', $course);

        $submissions = $assignment->submissions()->with('student')->get();
        $studentSubmission = $submissions->where('student_id', Auth::id())->first();

        return view('course.assignment', compact('course', 'assignment', 'submissions', 'studentSubmission'));
    }

    public function destroyAssignment(Course $course, Assignment $assignment)
    {
        $this->authorize('update', $course);

        $assignment->delete();

        return redirect()->route('courses.show', $course)
            ->with('success', 'Assignment berhasil dihapus');
    }

    public function updateAssignment(Request $request, Course $course, Assignment $assignment)
    {
        $this->authorize('update', $course);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'attachment_link' => 'nullable|url'
        ]);

        $assignment->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'attachment_link' => $request->attachment_link
        ]);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Assignment berhasil diperbarui');
    }
} 