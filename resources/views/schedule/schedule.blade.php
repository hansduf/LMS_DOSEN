@extends('template')

@section('content')
<div class="mr-[-25px] ml-[10px] mt-[70px] pt-[-10px] pb-10 bg-[#12131A] text-[#EBEBEB] h-[calc(100vh-130px)] transition-all duration-300 overflow-hidden rounded-xl mb-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 py-4 px-4">
        <!-- Date Selector -->
        <div class="flex flex-col">
            <span class="text-xs font-semibold text-gray-400">Date</span>
            <div class="relative">
                <button id="dateDropdown" class="bg-[#12131A] text-white px-4 py-2 rounded-lg flex items-center gap-2 w-[213px] h-[40px]">
                    <span id="selectedDate" class="text-xl font-medium">{{ now()->format('d M, Y') }}</span>
                    <i class="bi bi-chevron-down text-gray-400"></i>
                </button>
                <div id="calendarDropdown" class="hidden absolute z-10 mt-1 w-64 bg-[#12131A] rounded-lg shadow-lg p-4">
                    <!-- Calendar will be inserted here via JavaScript -->
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="relative w-full md:w-[384px]">
            <input type="search" id="scheduleSearch" class="block w-full h-[60px] p-4 pl-10 text-base font-normal bg-[#27354C] border-none rounded-lg focus:ring-blue-500 focus:border-blue-500 text-white" placeholder="&#xF52A; Search here">
        </div>

        <!-- View Toggle Buttons -->
        <div class="flex items-center gap-2 bg-[#27354C] rounded-lg p-1">
            <button id="weeklyBtn" class="px-4 py-2 rounded-lg bg-[#27354C] text-white hover:bg-[#2B2C32] transition">Weekly</button>
            <button id="monthlyBtn" class="px-4 py-2 rounded-lg bg-[#5EBAB4] text-white hover:bg-[#4CA8A2] transition">Monthly</button>
        </div>

        <!-- Create New Schedule Button -->
        <button id="createScheduleBtn" class="bg-[#27354C] text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-[#2B2C32] transition">
            <i class="bi bi-plus-lg"></i>
            Create new schedule
        </button>
    </div>

    <!-- Days Navigation -->
    <div class="relative mb-6 px-4">
        <div class="days-container overflow-x-auto pb-2 hide-scrollbar">
            <div class="flex space-x-4 min-w-max">
                @php
                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    $currentDate = now();
                    $currentDay = $currentDate->format('l');
                @endphp
                
                @foreach($days as $day)
                    <button class="day-item flex flex-col items-center {{ $day === $currentDay ? 'active' : '' }}" 
                            data-date="{{ $currentDate->format('Y-m-d') }}" 
                            data-day="{{ $day }}">
                        <span class="text-sm text-gray-400">{{ strtoupper(substr($day, 0, 3)) }}</span>
                        <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold {{ $day === $currentDay ? 'bg-[#5EBAB4] rounded-lg' : '' }}">{{ $currentDate->day }}</div>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Schedule Cards Container -->
    <div class="schedule-container h-[calc(100vh-370px)] overflow-y-auto overflow-x-auto px-0 ml-[-22px] mr-[-28px]">
        @php
            $semesters = $courses->groupBy('semester');
        @endphp

        @foreach($semesters as $semester => $semesterCourses)
            <!-- Semester Section -->
            <div class="mb-4 semester-section">
                <div class="bg-[#12131A] text-white py-2 px-4 mb-2 border border-[#2B2C32] ml-4">
                    <h3 class="text-lg font-medium">Semester {{ $semester }}</h3>
                </div>
                
                <div class="grid grid-cols-1 gap-4">
                    @php
                        $classes = $semesterCourses->groupBy('class');
                    @endphp

                    @foreach($classes as $class => $classCourses)
                        <!-- Class Row -->
                        <div class="flex items-center class-row">
                            <div class="w-48 min-w-[12rem] pr-4 font-medium bg-[#12131A]">{{ $class }}</div>
                            <div class="flex-1 overflow-x-auto">
                                <div class="schedule-row flex space-x-4 min-w-max overflow-x-auto hide-scrollbar">
                                    @foreach($classCourses as $course)
                                        <div class="schedule-card bg-[#27354C] rounded-lg p-4 w-64 border border-[#2B2C32]" 
                                             data-day="{{ $course->schedule_day }}">
                                            <div class="flex justify-between mb-2">
                                                <div>
                                                    <h4 class="font-medium">{{ $course->title }}</h4>
                                                    <div class="text-sm text-gray-400">{{ $course->course_code }}</div>
                                                </div>
                                                <div class="flex space-x-1">
                                                    <a href="{{ route('courses.edit', $course) }}" class="text-gray-400 hover:text-white">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <form action="{{ route('courses.destroy', $course) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-gray-400 hover:text-white" onclick="return confirm('Are you sure you want to delete this class?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="bg-[#615959] text-sm text-white py-1 px-2 rounded-xl mb-2 inline-block">
                                                {{ $course->location }}
                                            </div>
                                            <div class="flex justify-between text-sm mr-14">
                                                <div class="bg-[#4664A7] text-white py-1 px-2 rounded-xl">{{ $course->sks }} SKS</div>
                                                <div class="bg-[#4664A7] text-white py-1 px-2 rounded-xl">
                                                    {{ \Carbon\Carbon::parse($course->start_time)->format('H:i') }} - 
                                                    {{ \Carbon\Carbon::parse($course->start_time)->addMinutes($course->sks * 40)->format('H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Tambahkan referensi ke Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Tambahkan CSS untuk menyembunyikan scrollbar default -->
<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    /* Styling untuk scrollbar kustom */
    .scrollbar-container {
        position: relative;
    }
    
    /* Warna latar belakang untuk seluruh halaman */
    body {
        background-color: #0F1014;
    }
    
    /* Styling untuk tanggal yang aktif */
    .day-item.active div {
        background-color: #5EBAB4;
        border-radius: 0.5rem;
    }
    
    /* Styling untuk tabel jadwal */
    .schedule-container {
        border-collapse: collapse;
    }
    
    .schedule-container > div > div {
        border-bottom: 1px solid #2B2C32;
    }
    
    .schedule-container > div:last-child > div {
        border-bottom: none;
    }

    .day-item.active .w-16 {
        background-color: #5EBAB4;
        color: white;
    }

    .day-item:not(.active) .w-16:hover {
        background-color: #2B2C32;
        cursor: pointer;
    }

    .schedule-container::-webkit-scrollbar {
        height: 8px;
    }

    .schedule-container::-webkit-scrollbar-track {
        background: #1E1F25;
        border-radius: 4px;
    }

    .schedule-container::-webkit-scrollbar-thumb {
        background: #3B82F6;
        border-radius: 4px;
    }

    .schedule-container::-webkit-scrollbar-thumb:hover {
        background: #2563EB;
    }

    .schedule-card {
        display: none;
    }

    .schedule-card.active {
        display: block;
    }
</style>

<!-- Tambahkan referensi ke file JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all day items and schedule cards
    const dayItems = document.querySelectorAll('.day-item');
    const scheduleCards = document.querySelectorAll('.schedule-card');
    const semesterSections = document.querySelectorAll('.semester-section');
    const classRows = document.querySelectorAll('.class-row');

    // Function to update the selected date display
    function updateSelectedDate(date) {
        const selectedDate = document.getElementById('selectedDate');
        const formattedDate = new Date(date).toLocaleDateString('en-US', {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        });
        selectedDate.textContent = formattedDate;
    }

    // Function to filter schedule cards by day
    function filterScheduleByDay(day) {
        console.log('Filtering for day:', day); // Debug log

        // Hide all schedule cards first
        scheduleCards.forEach(card => {
            card.classList.remove('active');
            console.log('Card day:', card.dataset.day); // Debug log
        });

        // Show only cards matching the selected day
        scheduleCards.forEach(card => {
            if (card.dataset.day === day) {
                card.classList.add('active');
                console.log('Showing card for day:', day); // Debug log
            }
        });

        // Hide empty class rows
        classRows.forEach(row => {
            const hasVisibleCards = row.querySelector('.schedule-card.active');
            row.style.display = hasVisibleCards ? 'flex' : 'none';
        });

        // Hide empty semester sections
        semesterSections.forEach(section => {
            const hasVisibleRows = section.querySelector('.class-row[style="display: flex"]');
            section.style.display = hasVisibleRows ? 'block' : 'none';
        });
    }

    // Add click event listeners to day items
    dayItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all day items
            dayItems.forEach(d => d.classList.remove('active'));
            
            // Add active class to clicked item
            this.classList.add('active');
            
            // Update the selected date
            updateSelectedDate(this.dataset.date);
            
            // Filter schedule cards
            filterScheduleByDay(this.dataset.day);
        });
    });

    // Initialize with current day
    const currentDay = document.querySelector('.day-item.active');
    if (currentDay) {
        filterScheduleByDay(currentDay.dataset.day);
    }
});
</script>
@endsection