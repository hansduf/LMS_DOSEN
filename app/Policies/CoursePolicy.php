<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Course $course)
    {
        return $user->teacher && $user->teacher->teacher_id === $course->teacher_id ||
               $course->students()->where('user_id', $user->id)->exists();
    }

    public function update(User $user, Course $course)
    {
        return $user->teacher && $user->teacher->teacher_id === $course->teacher_id;
    }

    public function delete(User $user, Course $course)
    {
        return $user->teacher && $user->teacher->teacher_id === $course->teacher_id;
    }
} 