@extends('template')

@section('content')
<div class="container-fluid bg-[#12131A] text-white rounded-lg shadow-sm p-6 h-[calc(100vh-130px)] w-full max-w-6xl mx-auto overflow-hidden">
    <div class="h-full overflow-y-auto pr-2 custom-scrollbar">
        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/20 text-green-500 px-4 py-3 rounded-lg mb-6" role="alert">
                <div class="flex items-center">
                    <i class="bi bi-check-circle-fill mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Profile Information Section -->
        <div class="mb-6">
            <div class="flex items-center mb-2">
                <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mr-2">
                    <i class="bi bi-person-fill text-blue-600 text-sm"></i>
                </div>
                <h2 class="text-xl font-semibold">Profile Information</h2>
            </div>
            <p class="text-gray-400">Update your account's profile information and contact details.</p>
        </div>

        <div class="bg-[#1E1F25] rounded-lg p-6 border border-[#2B2C32] mb-8">
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-person text-gray-400"></i>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                                class="bg-[#12131A] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-envelope text-gray-400"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                class="bg-[#12131A] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="teacher_nik" class="block text-sm font-medium text-gray-300 mb-2">NIK <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-card-text text-gray-400"></i>
                            </div>
                            <input type="text" id="teacher_nik" name="teacher_nik" value="{{ old('teacher_nik', $teacher->teacher_nik) }}" 
                                class="bg-[#12131A] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                        </div>
                        @error('teacher_nik')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Specialization -->
                    <div>
                        <label for="teacher_specialization" class="block text-sm font-medium text-gray-300 mb-2">Specialization <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-book text-gray-400"></i>
                            </div>
                            <input type="text" id="teacher_specialization" name="teacher_specialization" value="{{ old('teacher_specialization', $teacher->teacher_specialization) }}" 
                                class="bg-[#12131A] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                        </div>
                        @error('teacher_specialization')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Position -->
                    <div>
                        <label for="teacher_position" class="block text-sm font-medium text-gray-300 mb-2">Position <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-person-badge text-gray-400"></i>
                            </div>
                            <input type="text" id="teacher_position" name="teacher_position" value="{{ old('teacher_position', $teacher->teacher_position) }}" 
                                class="bg-[#12131A] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                        </div>
                        @error('teacher_position')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="teacher_phone" class="block text-sm font-medium text-gray-300 mb-2">Phone <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-phone text-gray-400"></i>
                            </div>
                            <input type="text" id="teacher_phone" name="teacher_phone" value="{{ old('teacher_phone', $teacher->teacher_phone) }}" 
                                class="bg-[#12131A] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                        </div>
                        @error('teacher_phone')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Photo -->
                    <div>
                        <label for="teacher_photo" class="block text-sm font-medium text-gray-300 mb-2">Photo</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-image text-gray-400"></i>
                            </div>
                            <input type="file" id="teacher_photo" name="teacher_photo" 
                                class="bg-[#12131A] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                        @error('teacher_photo')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        @if($teacher->teacher_photo)
                            <div class="mt-2">
                                <img src="{{ asset($teacher->teacher_photo) }}" alt="Profile Photo" class="w-20 h-20 rounded-full object-cover">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Save Button -->
                <div>
                    <button type="submit" class="flex items-center bg-[#5EBAB4] hover:bg-[#4CA8A2] text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                        <i class="bi bi-check-lg mr-2"></i>
                        SAVE CHANGES
                    </button>
                </div>
            </form>
        </div>

        <!-- Update Password Section -->
        <div class="mb-6">
            <div class="flex items-center mb-2">
                <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mr-2">
                    <i class="bi bi-lock-fill text-blue-600 text-sm"></i>
                </div>
                <h2 class="text-xl font-semibold">Update Password</h2>
            </div>
            <p class="text-gray-400">Ensure your account is using a long, random password to stay secure.</p>
        </div>

        <div class="bg-[#1E1F25] rounded-lg p-6 border border-[#2B2C32] mb-8">
            <form action="{{ route('profile.password') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-300 mb-2">Current Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="current_password" name="current_password" 
                            class="bg-[#12131A] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                    </div>
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-300 mb-2">New Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="new_password" name="new_password" 
                            class="bg-[#12131A] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                    </div>
                    @error('new_password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-400">Minimum 8 characters, with at least one uppercase, one lowercase, one number and one special character.</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                            class="bg-[#12131A] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                    </div>
                </div>

                <!-- Update Password Button -->
                <div>
                    <button type="submit" class="flex items-center bg-[#5EBAB4] hover:bg-[#4CA8A2] text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                        <i class="bi bi-check-lg mr-2"></i>
                        UPDATE PASSWORD
                    </button>
                </div>
            </form>
        </div>

        <!-- Delete Account Section -->
        <div class="mb-6">
            <div class="flex items-center mb-2">
                <div class="w-6 h-6 rounded-full bg-red-100 flex items-center justify-center mr-2">
                    <i class="bi bi-exclamation-triangle-fill text-red-600 text-sm"></i>
                </div>
                <h2 class="text-xl font-semibold">Delete Account</h2>
            </div>
            <p class="text-gray-400">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
            <p class="text-gray-400">Before deleting your account, please download any data or information that you wish to retain.</p>
        </div>

        <div class="bg-[#1E1F25] rounded-lg p-6 border border-[#2B2C32]">
            <form action="{{ route('profile.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                
                <!-- Password Confirmation -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" 
                            class="bg-[#12131A] border border-[#2B2C32] text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Delete Account Button -->
                <button type="submit" class="flex items-center bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                    <i class="bi bi-trash mr-2"></i>
                    DELETE ACCOUNT
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan CSS untuk custom scrollbar -->
<style>
    /* Styling untuk scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #12131A;
        border-radius: 4px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #2B2C32;
        border-radius: 4px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #3E3F46;
    }
    
    /* Pastikan halaman utama tidak memiliki scrollbar */
    body {
        overflow: hidden;
    }
</style>

<!-- Tambahkan Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endsection