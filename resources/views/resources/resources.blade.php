@extends('template')

@section('content')
<div class="container-fluid p-2 m-4 bg-[#12131A] text-white rounded-2xl shadow-sm h-[calc(100vh-120px)] w-[calc(100%+40px)] overflow-hidden">
    <div class="h-full overflow-y-auto pl-2 pr-10" style="-ms-overflow-style: none; scrollbar-width: none;">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center">
                <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mr-2">
                    <i class="bi bi-book text-blue-600 text-sm"></i>
                </div>
                <h2 class="text-xl font-semibold">Courses</h2>
            </div>
            
            <div class="flex items-center space-x-4 pr-2">
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
        
        <!-- Courses Grid - 4 cards per row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 pb-4">
            <!-- Course Card 1 - Design -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="absolute flex justify-between items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 2 - Business -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105">
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="absolute bottom: 0 left:0 right:0 flex justify-between items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 3 - Code -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 4 - Design -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 5 - Design -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 6 - Code -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 7 - Design -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 8 - Business -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 9 - Code -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 10 - Design -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 11 - Business -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 12 - Code -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- Course Card 13 - Design -->
                    <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 14 - Business -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 15 - Code -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 16 - Design -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 17 - Business -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
                        <!-- Course Card 12 - Code -->
                        <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course Card 18 - Code -->
            <div class="bg-[#383838] rounded-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105" >
                <div class="h-[175px]">
                    <div class="grid grid-cols-2 items-end">
                    <a href="https://www.blender.org/" target="_blank">
                        <button>
                            <img src="{{ asset('storage/images/Blender_logo_no_text.svg.png') }}" alt="Create 3D With Blender" class="w-8 h-8 rounded hover:transform hover:scale-125 transition duration-500">
                        </button>
                    </a>
                    <!-- Tombol Edit dan Delete di posisi yang tepat -->
                    <div class="grid grid-cols-2 items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs p-2 rounded text-center">
                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                        </button>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 items-end">
                        <div class="space-y-1.25">
                            <div class="text-blue-400 text-xs font-semibold uppercase tracking-wide" style="font-size: 12px;">Design</div>
                            <h3 class="text-sm font-semibold text-white" style="font-size: 12px;">Create 3D With Blender</h3>
                            <div class="text-xs text-red-400" style="font-size: 10px;">Information Technology</div>
                            <div class="text-xs text-gray-400" style="font-size: 10px;">30 Resources</div>
                        </div>
                        <div class="grid grid-cols-2 items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 hover:transform hover:scale-110 transition duration-500 text-white font-semibold text-xs py-1 px-3 rounded text-center" style="font-size: 12px; max-height: 25px; min-width: 75px;">
                                Preview
                            </button>
                        </div>
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