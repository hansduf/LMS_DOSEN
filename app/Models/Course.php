<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'course_code',
        'title',
        'description',
        'thumbnail',
        'class_color',
        'schedule_day',
        'start_time',
        'sks',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_time' => 'datetime',
        'sks' => 'integer'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function materials()
    {
        return $this->hasMany(Material::class)->latest();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class)->latest();
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class)->orderBy('due_date');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->withPivot('enrolled_at')
            ->withTimestamps();
    }

    public function generateCourseCode()
    {
        do {
            $code = strtoupper(substr(md5(uniqid()), 0, 6));
        } while (static::where('course_code', $code)->exists());

        return $code;
    }

    public function getDurationAttribute()
    {
        return $this->sks * 40; // 1 SKS = 40 menit
    }
} 