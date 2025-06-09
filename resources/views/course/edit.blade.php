@extends('template')

@section('content')
<div class="container mx-auto px-4 py-8 mb-20">
    <div class="max-w-2xl mx-auto">
        <!-- Navigation Scroll -->
        <div class="bg-[#1E1F25] rounded-lg shadow-lg mb-6 sticky top-0 z-10">
            <div class="flex justify-between items-center p-4">
                <h1 class="text-2xl font-bold text-[#EBEBEB]">Edit Class</h1>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('course') }}" class="text-[#EBEBEB] hover:text-gray-300">
                        <i class="bi bi-arrow-left"></i> Back to Classes
                    </a>
                    <button type="submit" form="edit-class-form" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors flex items-center">
                        <i class="bi bi-save mr-2"></i>
                        Save Changes
                    </button>
                </div>
            </div>
            <div class="flex space-x-4 px-4 pb-4 overflow-x-auto custom-scrollbar">
                <a href="#basic-info" class="nav-link text-[#EBEBEB] hover:text-blue-400 whitespace-nowrap">Basic Info</a>
                <a href="#schedule" class="nav-link text-[#EBEBEB] hover:text-blue-400 whitespace-nowrap">Schedule</a>
            </div>
        </div>

        <form id="edit-class-form" action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data" class="bg-[#12131A] rounded-lg shadow-lg p-6 custom-scrollbar" style="max-height: calc(100vh - 200px); overflow-y: auto;">
            @csrf
            @method('PUT')
            
            <!-- Basic Info Section -->
            <div id="basic-info" class="mb-8">
                <h2 class="text-xl font-semibold text-[#EBEBEB] mb-4">Basic Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="title" class="block text-[#EBEBEB] mb-2">Class Name</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required>
                    </div>

                    <div>
                        <label for="semester" class="block text-[#EBEBEB] mb-2">Semester</label>
                        <select name="semester" id="semester" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500 custom-scrollbar" required>
                            <option value="">Select Semester</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('semester', $course->semester) == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-[#EBEBEB] mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500 custom-scrollbar" required>{{ old('description', $course->description) }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="class_color" class="block text-[#EBEBEB] mb-2">Class Color</label>
                    <select name="class_color" id="class_color" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500 custom-scrollbar" required>
                        <option value="">Select Color</option>
                        <optgroup label="Blue">
                            <option value="blue-400" class="text-blue-400" {{ old('class_color', $course->class_color) == 'blue-400' ? 'selected' : '' }}>Light Blue</option>
                            <option value="blue-500" class="text-blue-500" {{ old('class_color', $course->class_color) == 'blue-500' ? 'selected' : '' }}>Blue</option>
                            <option value="blue-600" class="text-blue-600" {{ old('class_color', $course->class_color) == 'blue-600' ? 'selected' : '' }}>Dark Blue</option>
                            <option value="blue-700" class="text-blue-700" {{ old('class_color', $course->class_color) == 'blue-700' ? 'selected' : '' }}>Darker Blue</option>
                        </optgroup>
                        <optgroup label="Green">
                            <option value="green-400" class="text-green-400" {{ old('class_color', $course->class_color) == 'green-400' ? 'selected' : '' }}>Light Green</option>
                            <option value="green-500" class="text-green-500" {{ old('class_color', $course->class_color) == 'green-500' ? 'selected' : '' }}>Green</option>
                            <option value="green-600" class="text-green-600" {{ old('class_color', $course->class_color) == 'green-600' ? 'selected' : '' }}>Dark Green</option>
                            <option value="green-700" class="text-green-700" {{ old('class_color', $course->class_color) == 'green-700' ? 'selected' : '' }}>Darker Green</option>
                        </optgroup>
                        <optgroup label="Purple">
                            <option value="purple-400" class="text-purple-400" {{ old('class_color', $course->class_color) == 'purple-400' ? 'selected' : '' }}>Light Purple</option>
                            <option value="purple-500" class="text-purple-500" {{ old('class_color', $course->class_color) == 'purple-500' ? 'selected' : '' }}>Purple</option>
                            <option value="purple-600" class="text-purple-600" {{ old('class_color', $course->class_color) == 'purple-600' ? 'selected' : '' }}>Dark Purple</option>
                            <option value="purple-700" class="text-purple-700" {{ old('class_color', $course->class_color) == 'purple-700' ? 'selected' : '' }}>Darker Purple</option>
                        </optgroup>
                        <optgroup label="Pink">
                            <option value="pink-400" class="text-pink-400" {{ old('class_color', $course->class_color) == 'pink-400' ? 'selected' : '' }}>Light Pink</option>
                            <option value="pink-500" class="text-pink-500" {{ old('class_color', $course->class_color) == 'pink-500' ? 'selected' : '' }}>Pink</option>
                            <option value="pink-600" class="text-pink-600" {{ old('class_color', $course->class_color) == 'pink-600' ? 'selected' : '' }}>Dark Pink</option>
                            <option value="pink-700" class="text-pink-700" {{ old('class_color', $course->class_color) == 'pink-700' ? 'selected' : '' }}>Darker Pink</option>
                        </optgroup>
                    </select>
                </div>
            </div>

            <!-- Schedule Section -->
            <div id="schedule" class="mb-8">
                <h2 class="text-xl font-semibold text-[#EBEBEB] mb-4">Schedule</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="schedule_day" class="block text-[#EBEBEB] mb-2">Schedule Day</label>
                        <select name="schedule_day" id="schedule_day" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500 custom-scrollbar" required>
                            <option value="">Select Day</option>
                            <option value="Monday" {{ old('schedule_day', $course->schedule_day) == 'Monday' ? 'selected' : '' }}>Monday</option>
                            <option value="Tuesday" {{ old('schedule_day', $course->schedule_day) == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                            <option value="Wednesday" {{ old('schedule_day', $course->schedule_day) == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                            <option value="Thursday" {{ old('schedule_day', $course->schedule_day) == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                            <option value="Friday" {{ old('schedule_day', $course->schedule_day) == 'Friday' ? 'selected' : '' }}>Friday</option>
                            <option value="Saturday" {{ old('schedule_day', $course->schedule_day) == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                        </select>
                    </div>

                    <div>
                        <label for="start_time" class="block text-[#EBEBEB] mb-2">Start Time</label>
                        <input type="time" name="start_time" id="start_time" value="{{ old('start_time', \Carbon\Carbon::parse($course->start_time)->format('H:i')) }}" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="sks" class="block text-[#EBEBEB] mb-2">SKS</label>
                    <select name="sks" id="sks" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500 custom-scrollbar" required>
                        <option value="">Select SKS</option>
                        <option value="1" {{ old('sks', $course->sks) == 1 ? 'selected' : '' }}>1 SKS (40 minutes)</option>
                        <option value="2" {{ old('sks', $course->sks) == 2 ? 'selected' : '' }}>2 SKS (80 minutes)</option>
                        <option value="3" {{ old('sks', $course->sks) == 3 ? 'selected' : '' }}>3 SKS (120 minutes)</option>
                        <option value="4" {{ old('sks', $course->sks) == 4 ? 'selected' : '' }}>4 SKS (160 minutes)</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label for="thumbnail" class="block text-[#EBEBEB] mb-2">Class Thumbnail (Optional)</label>
                @if($course->thumbnail)
                    <div class="mb-2">
                        <img src="{{ Storage::url($course->thumbnail) }}" alt="Current Thumbnail" class="w-32 h-32 object-cover rounded-lg">
                    </div>
                @endif
                <input type="file" name="thumbnail" id="thumbnail" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" accept="image/*">
                <p class="text-xs text-gray-400 mt-1">Leave empty to keep current thumbnail</p>
            </div>

            <!-- Extra padding at the bottom -->
            <div class="h-20"></div>
        </form>
    </div>
</div>

<style>
    /* Custom Scrollbar Styles */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #1E1F25;
        border-radius: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #3B82F6;
        border-radius: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #2563EB;
    }

    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Active navigation link */
    .nav-link.active {
        color: #3B82F6;
        border-bottom: 2px solid #3B82F6;
    }

    /* Form container scroll */
    form.custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #3B82F6 #1E1F25;
    }

    /* Textarea scroll */
    textarea.custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #3B82F6 #1E1E25;
    }

    /* Select scroll */
    select.custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #3B82F6 #1E1E25;
    }
</style>

<script>
    // Highlight active section in navigation
    document.addEventListener('scroll', function() {
        const sections = document.querySelectorAll('div[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (pageYOffset >= sectionTop - 60) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').substring(1) === current) {
                link.classList.add('active');
            }
        });
    });

    // Add smooth scroll to navigation links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            targetSection.scrollIntoView({ behavior: 'smooth' });
        });
    });
</script>
@endsection 