@extends('template')

@section('content')
<div class="mt-[-20px] mr-[-33px] p-[10px] text-[#EBEBEB] transition-all duration-300 overflow-hidden">
    <div class="bg-[#12131A] rounded-2xl shadow-sm p-4 h-[calc(100vh-120px)] overflow-hidden">
        <div class="h-full overflow-y-auto pr-2 pl-2 custom-scrollbar">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mr-2">
                        <i class="bi bi-book text-blue-600 text-sm"></i>
                    </div>
                    <h2 class="text-xl font-semibold">Courses</h2>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <div class="relative">
                        <div class="flex items-center bg-[#1E1F25] border border-[#2B2C32] rounded-lg px-3 py-2">
                            <i class="bi bi-search text-gray-400 mr-2"></i>
                            <input type="text" placeholder="Cari kursus..." class="bg-transparent border-none focus:ring-0 text-sm w-64 text-white">
                        </div>
                    </div>
                    
                    <!-- Add Course Button -->
                    <button class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                        <i class="bi bi-plus-lg mr-2"></i>
                        Add Course
                    </button>
                </div>
            </div>
            
            <!-- Courses Grid - 6 cards per row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                <!-- Course Card 1 - Design -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/FF6B35/FFFFFF" alt="Create 3D With Blender" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $400
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide mb-1">DESIGN</div>
                        <h3 class="text-base font-semibold text-white mb-2">Create 3D With Blender</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>16 Lessons</div>
                            <div>48 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-blue-400 hover:text-blue-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 2 - Business -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/9370DB/FFFFFF" alt="Digital Marketing" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $100
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-purple-400 text-xs font-semibold uppercase tracking-wide mb-1">BUSINESS</div>
                        <h3 class="text-base font-semibold text-white mb-2">Digital Marketing</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>30 Lessons</div>
                            <div>48 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-purple-400 hover:text-purple-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 3 - Code -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/8A2BE2/FFFFFF" alt="Slicing UI Design With Tailwind" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $100
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-indigo-400 text-xs font-semibold uppercase tracking-wide mb-1">CODE</div>
                        <h3 class="text-base font-semibold text-white mb-2">Slicing UI Design With Tailwind</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>30 Lessons</div>
                            <div>48 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-indigo-400 hover:text-indigo-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 4 - Design -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/FF6B35/FFFFFF" alt="UI/UX Design Fundamentals" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $250
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide mb-1">DESIGN</div>
                        <h3 class="text-base font-semibold text-white mb-2">UI/UX Design Fundamentals</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>24 Lessons</div>
                            <div>36 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-blue-400 hover:text-blue-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 5 - Business -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/9370DB/FFFFFF" alt="Social Media Strategy" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $150
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-purple-400 text-xs font-semibold uppercase tracking-wide mb-1">BUSINESS</div>
                        <h3 class="text-base font-semibold text-white mb-2">Social Media Strategy</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>20 Lessons</div>
                            <div>30 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-purple-400 hover:text-purple-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 6 - Code -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/8A2BE2/FFFFFF" alt="React JS Fundamentals" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $200
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-indigo-400 text-xs font-semibold uppercase tracking-wide mb-1">CODE</div>
                        <h3 class="text-base font-semibold text-white mb-2">React JS Fundamentals</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>25 Lessons</div>
                            <div>40 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-indigo-400 hover:text-indigo-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 7 - Design -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/FF6B35/FFFFFF" alt="Photoshop Masterclass" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $180
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide mb-1">DESIGN</div>
                        <h3 class="text-base font-semibold text-white mb-2">Photoshop Masterclass</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>22 Lessons</div>
                            <div>35 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-blue-400 hover:text-blue-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 8 - Business -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/9370DB/FFFFFF" alt="Business Analytics" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $220
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-purple-400 text-xs font-semibold uppercase tracking-wide mb-1">BUSINESS</div>
                        <h3 class="text-base font-semibold text-white mb-2">Business Analytics</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>28 Lessons</div>
                            <div>45 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-purple-400 hover:text-purple-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 9 - Code -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/8A2BE2/FFFFFF" alt="Python for Data Science" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $280
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-indigo-400 text-xs font-semibold uppercase tracking-wide mb-1">CODE</div>
                        <h3 class="text-base font-semibold text-white mb-2">Python for Data Science</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>32 Lessons</div>
                            <div>50 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-indigo-400 hover:text-indigo-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 10 - Design -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/FF6B35/FFFFFF" alt="Illustrator for Beginners" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $150
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide mb-1">DESIGN</div>
                        <h3 class="text-base font-semibold text-white mb-2">Illustrator for Beginners</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>18 Lessons</div>
                            <div>30 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-blue-400 hover:text-blue-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 11 - Business -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/9370DB/FFFFFF" alt="Project Management" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $190
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-purple-400 text-xs font-semibold uppercase tracking-wide mb-1">BUSINESS</div>
                        <h3 class="text-base font-semibold text-white mb-2">Project Management</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>24 Lessons</div>
                            <div>38 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-purple-400 hover:text-purple-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 12 - Code -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/8A2BE2/FFFFFF" alt="Vue.js for Frontend" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $170
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-indigo-400 text-xs font-semibold uppercase tracking-wide mb-1">CODE</div>
                        <h3 class="text-base font-semibold text-white mb-2">Vue.js for Frontend</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>26 Lessons</div>
                            <div>42 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-indigo-400 hover:text-indigo-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                <!-- Course Card 13 - Design -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/FF6B35/FFFFFF" alt="Motion Graphics" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $230
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide mb-1">DESIGN</div>
                        <h3 class="text-base font-semibold text-white mb-2">Motion Graphics</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>28 Lessons</div>
                            <div>45 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-blue-400 hover:text-blue-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 14 - Business -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/9370DB/FFFFFF" alt="E-commerce Strategy" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $175
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-purple-400 text-xs font-semibold uppercase tracking-wide mb-1">BUSINESS</div>
                        <h3 class="text-base font-semibold text-white mb-2">E-commerce Strategy</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>22 Lessons</div>
                            <div>36 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-purple-400 hover:text-purple-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 15 - Code -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/8A2BE2/FFFFFF" alt="Node.js Backend" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $210
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-indigo-400 text-xs font-semibold uppercase tracking-wide mb-1">CODE</div>
                        <h3 class="text-base font-semibold text-white mb-2">Node.js Backend</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>30 Lessons</div>
                            <div>48 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-indigo-400 hover:text-indigo-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 16 - Design -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/FF6B35/FFFFFF" alt="Typography Mastery" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $120
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide mb-1">DESIGN</div>
                        <h3 class="text-base font-semibold text-white mb-2">Typography Mastery</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>15 Lessons</div>
                            <div>25 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-blue-400 hover:text-blue-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Course Card 17 - Business -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/9370DB/FFFFFF" alt="Financial Planning" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $195
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-purple-400 text-xs font-semibold uppercase tracking-wide mb-1">BUSINESS</div>
                        <h3 class="text-base font-semibold text-white mb-2">Financial Planning</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>26 Lessons</div>
                            <div>40 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-purple-400 hover:text-purple-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                <!-- Course Card 18 - Code -->
                <div class="bg-[#1E1F25] rounded-lg overflow-hidden border border-[#2B2C32] transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <img src="https://via.placeholder.com/400x200/8A2BE2/FFFFFF" alt="Mobile App Development" class="w-full h-36 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-gray-800 font-bold py-1 px-3 rounded-full">
                            $260
                        </div>
                        <button class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-lg">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="text-indigo-400 text-xs font-semibold uppercase tracking-wide mb-1">CODE</div>
                        <h3 class="text-base font-semibold text-white mb-2">Mobile App Development</h3>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div>35 Lessons</div>
                            <div>55 Hours</div>
                        </div>
                    </div>
                    <div class="bg-[#161719] p-3 flex justify-between items-center">
                        <button class="text-indigo-400 hover:text-indigo-300">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>    
            </div>
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