@extends('template')

@section('content')
<div class="container mx-auto px-4 py-8 mb-20">
    <div class="max-w-2xl mx-auto">
        <!-- Navigation Scroll -->
        <div class="bg-[#1E1F25] rounded-lg shadow-lg mb-6 sticky top-0 z-10">
            <div class="flex justify-between items-center p-4">
                <h1 class="text-2xl font-bold text-[#EBEBEB]">Create New Class</h1>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('courses.index') }}" class="text-[#EBEBEB] hover:text-gray-300">
                        <i class="bi bi-arrow-left"></i> Back to Classes
                    </a>
                    <button type="submit" form="create-class-form" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors flex items-center">
                        <i class="bi bi-plus-circle mr-2"></i>
                        Create Class
                    </button>
                </div>
            </div>
            <div class="flex space-x-4 px-4 pb-4 overflow-x-auto custom-scrollbar">
                <a href="#basic-info" class="nav-link text-[#EBEBEB] hover:text-blue-400 whitespace-nowrap">Basic Info</a>
                <a href="#schedule" class="nav-link text-[#EBEBEB] hover:text-blue-400 whitespace-nowrap">Schedule</a>
            </div>
        </div>

        <form id="create-class-form" action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="bg-[#12131A] rounded-lg shadow-lg p-6 custom-scrollbar" style="max-height: calc(100vh - 200px); overflow-y: auto;">
            @csrf
            
            <!-- Basic Info Section -->
            <div id="basic-info" class="mb-8">
                <h2 class="text-xl font-semibold text-[#EBEBEB] mb-4">Basic Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="title" class="block text-[#EBEBEB] mb-2">Class Name</label>
                        <input type="text" name="title" id="title" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required>
                    </div>

                    <div>
                        <label for="semester" class="block text-[#EBEBEB] mb-2">Semester</label>
                        <select name="semester" id="semester" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500 custom-scrollbar" required>
                            <option value="">Select Semester</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                            <option value="3">Semester 3</option>
                            <option value="4">Semester 4</option>
                            <option value="5">Semester 5</option>
                            <option value="6">Semester 6</option>
                            <option value="7">Semester 7</option>
                            <option value="8">Semester 8</option>
                        </select>
                    </div>

                    <div>
                        <label for="class_color" class="block text-[#EBEBEB] mb-2">Class Color</label>
                        <select name="class_color" id="class_color" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500 custom-scrollbar" required>
                            <option value="">Select Color</option>
                            <optgroup label="Blue">
                                <option value="blue-400" class="text-blue-400">Light Blue</option>
                                <option value="blue-500" class="text-blue-500">Blue</option>
                                <option value="blue-600" class="text-blue-600">Dark Blue</option>
                                <option value="blue-700" class="text-blue-700">Darker Blue</option>
                            </optgroup>
                            <optgroup label="Green">
                                <option value="green-400" class="text-green-400">Light Green</option>
                                <option value="green-500" class="text-green-500">Green</option>
                                <option value="green-600" class="text-green-600">Dark Green</option>
                                <option value="green-700" class="text-green-700">Darker Green</option>
                            </optgroup>
                            <optgroup label="Purple">
                                <option value="purple-400" class="text-purple-400">Light Purple</option>
                                <option value="purple-500" class="text-purple-500">Purple</option>
                                <option value="purple-600" class="text-purple-600">Dark Purple</option>
                                <option value="purple-700" class="text-purple-700">Darker Purple</option>
                            </optgroup>
                            <optgroup label="Pink">
                                <option value="pink-400" class="text-pink-400">Light Pink</option>
                                <option value="pink-500" class="text-pink-500">Pink</option>
                                <option value="pink-600" class="text-pink-600">Dark Pink</option>
                                <option value="pink-700" class="text-pink-700">Darker Pink</option>
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-[#EBEBEB] mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500 custom-scrollbar" required></textarea>
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
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </div>

                    <div>
                        <label for="start_time" class="block text-[#EBEBEB] mb-2">Start Time</label>
                        <input type="time" name="start_time" id="start_time" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="sks" class="block text-[#EBEBEB] mb-2">SKS</label>
                    <select name="sks" id="sks" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required>
                        <option value="">Pilih SKS</option>
                        <option value="1">1 SKS (40 menit)</option>
                        <option value="2">2 SKS (80 menit)</option>
                        <option value="3">3 SKS (120 menit)</option>
                        <option value="4">4 SKS (160 menit)</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="location" class="block text-[#EBEBEB] mb-2">Lokasi Kelas</label>
                    <input type="text" name="location" id="location" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" placeholder="Contoh: Ruang 301, Gedung A" required>
                </div>
            </div>

            <div class="mb-6">
                <label for="thumbnail" class="block text-[#EBEBEB] mb-2">Class Thumbnail (Optional)</label>
                <input type="file" name="thumbnail" id="thumbnail" class="w-full px-4 py-2 bg-[#1E1F25] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" accept="image/*">
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
        scrollbar-color: #3B82F6 #1E1F25;
    }

    /* Select scroll */
    select.custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #3B82F6 #1E1F25;
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