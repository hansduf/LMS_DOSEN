<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * @property User $user
 * @property Teacher $teacher
 */
class ProfileController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Teacher $teacher */
        $teacher = $user->teacher;
        
        return view('profile.profile', compact('user', 'teacher'));
    }

    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Teacher $teacher */
        $teacher = $user->teacher;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'teacher_nik' => ['required', 'string', 'max:255', Rule::unique('teachers')->ignore($teacher->teacher_id, 'teacher_id')],
            'teacher_specialization' => ['required', 'string', 'max:255'],
            'teacher_position' => ['required', 'string', 'max:255'],
            'teacher_phone' => ['required', 'string', 'max:255'],
            'teacher_photo' => ['nullable', 'image', 'max:2048'],
        ]);

        // Update User data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Update Teacher data
        $teacher->teacher_name = $request->name;
        $teacher->teacher_nik = $request->teacher_nik;
        $teacher->teacher_specialization = $request->teacher_specialization;
        $teacher->teacher_position = $request->teacher_position;
        $teacher->teacher_phone = $request->teacher_phone;

        // Handle photo upload
        if ($request->hasFile('teacher_photo')) {
            $photo = $request->file('teacher_photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/teachers'), $photoName);
            $teacher->teacher_photo = 'uploads/teachers/' . $photoName;
        }

        $teacher->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        // Update teacher password as well
        $user->teacher->teacher_password = Hash::make($request->new_password);
        $user->teacher->save();

        return redirect()->route('profile')->with('success', 'Password updated successfully');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The password is incorrect']);
        }

        // Delete the user (this will cascade delete the teacher record)
        $user->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Account deleted successfully');
    }
} 