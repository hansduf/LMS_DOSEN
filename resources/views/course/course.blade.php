@extends('template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6 sticky top-0 bg-[#12131A] z-10 py-4">
        <h1 class="text-2xl font-bold text-[#EBEBEB]">My Classes</h1>
        <a href="{{ route('courses.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
            <i class="bi bi-plus-lg mr-2"></i>
            New Class
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-900 border border-green-700 text-green-300 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-h-[calc(100vh-200px)] overflow-y-auto custom-scrollbar pr-2 pb-32">
        @forelse($courses as $course)
            <div class="bg-[#1E1F25] rounded-lg shadow-lg overflow-hidden">
                @if($course->thumbnail)
                    <div class="h-40 overflow-hidden">
                        <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <div class="text-{{ $course->class_color }} text-xs font-semibold uppercase tracking-wide">
                            {{ $course->course_code }}
                        </div>
                        <div class="text-{{ $course->class_color }} text-xs font-semibold">
                            Semester {{ $course->semester }}
                        </div>
                    </div>
                    <h3 class="text-base font-semibold text-[#EBEBEB] mb-2">{{ $course->title }}</h3>
                    <p class="text-sm text-gray-400 mb-3 line-clamp-2">{{ $course->description }}</p>
                    
                    <div class="space-y-2 mb-3">
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div class="flex items-center">
                                <i class="bi bi-clock mr-1"></i>
                                {{ $course->schedule_day }}, {{ \Carbon\Carbon::parse($course->start_time)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($course->start_time)->addMinutes($course->sks * 40)->format('H:i') }}
                            </div>
                            <div class="flex items-center">
                                <i class="bi bi-people mr-1"></i>
                                {{ $course->students->count() }} Students
                            </div>
                        </div>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div class="flex items-center">
                                <i class="bi bi-geo-alt mr-1"></i>
                                {{ $course->location }}
                            </div>
                            <div class="flex items-center">
                                <i class="bi bi-file-text mr-1"></i>
                                {{ $course->materials->count() }} Materials
                            </div>
                        </div>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <div class="flex items-center">
                                <i class="bi bi-journal-text mr-1"></i>
                                {{ $course->assignments->count() }} Assignments
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end space-x-2">
                        <a href="{{ route('courses.show', $course) }}" class="text-{{ $course->class_color }} hover:text-{{ $course->class_color }}-300">
                            <i class="bi bi-eye text-lg"></i>
                        </a>
                        <a href="{{ route('courses.edit', $course) }}" class="text-{{ $course->class_color }} hover:text-{{ $course->class_color }}-300">
                            <i class="bi bi-pencil text-lg"></i>
                        </a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Are you sure you want to delete this class?')">
                                <i class="bi bi-trash text-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-12 bg-[#1E1F25] rounded-lg">
                    <i class="bi bi-folder-x text-4xl text-gray-500"></i>
                    <h3 class="mt-2 text-sm font-medium text-[#EBEBEB]">No classes</h3>
                    <p class="mt-1 text-sm text-gray-400">Get started by creating a new class.</p>
                    <div class="mt-6">
                        <a href="{{ route('courses.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="bi bi-plus-lg mr-2"></i>
                            New Class
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

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
</style>
@endsection