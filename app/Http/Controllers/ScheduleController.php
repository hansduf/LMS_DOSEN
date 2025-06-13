<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;
        $courses = Course::where('teacher_id', $teacher->teacher_id)
                        ->orderBy('semester')
                        ->orderBy('schedule_day')
                        ->orderBy('start_time')
                        ->get();
        
        return view('schedule.schedule', compact('courses'));
    }
} 