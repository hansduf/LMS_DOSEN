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
                    <span id="selectedDate" class="text-xl font-medium">22 Dec, 2025</span>
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
                <!-- Day Items -->
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">MON</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">17</div>
                </button>
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">TUE</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">18</div>
                </button>
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">WED</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">19</div>
                </button>
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">THU</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">20</div>
                </button>
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">FRI</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">21</div>
                </button>
                <button class="day-item flex flex-col items-center active">
                    <span class="text-sm text-gray-400">SAT</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold bg-[#5EBAB4] rounded-lg">22</div>
                </button>
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">SUN</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">23</div>
                </button>
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">MON</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">24</div>
                </button>
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">TUE</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">25</div>
                </button>
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">WED</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">26</div>
                </button>
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">THU</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">27</div>
                </button>
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">FRI</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">28</div>
                </button>
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">SAT</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">29</div>
                </button>
                <button class="day-item flex flex-col items-center">
                    <span class="text-sm text-gray-400">SAT</span>
                    <div class="w-16 h-16 flex items-center justify-center text-2xl font-bold">30</div>
                </button>
            </div>
        </div>

    <!-- Schedule Cards Container -->
    <div class="schedule-container h-[calc(100vh-370px)] overflow-y-auto overflow-x-auto px-0 ml-[-22px] mr-[-28px]">
        <!-- Information Technology Section -->
        <div class="mb-4">
            <div class="bg-[#12131A] text-white py-2 px-4 mb-2 border border-[#2B2C32]">
                <h3 class="text-lg font-medium">Information Technology</h3>
            </div>
            
            <div class="grid grid-cols-1 gap-4">
                <!-- Row A -->
                <div class="flex items-center">
                    <div class="w-48 min-w-[12rem] pr-4 font-medium bg-[#12131A]">Information Technology A</div>
                    <div class="flex-1 overflow-x-auto">
                        <div class="schedule-row flex space-x-4 min-w-max overflow-x-auto hide-scrollbar">
                            <!-- Schedule Cards -->
                            @for ($i = 0; $i < 7; $i++)
                            <div class="schedule-card bg-[#27354C] rounded-lg p-4 w-64 border border-[#2B2C32]">
                                <div class="flex justify-between mb-2">
                                    <h4 class="font-medium">Internet of Things</h4>
                                    <div class="flex space-x-1">
                                        <button class="text-gray-400 hover:text-white">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-white">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="bg-[#615959] text-sm text-white py-1 px-2 rounded-xl mb-2 inline-block">
                                    Gedung Dieng A303
                                </div>
                                <div class="flex justify-between text-sm mr-14">
                                    <div class="bg-[#4664A7] text-white py-1 px-2 rounded-xl">2 SKS</div>
                                    <div class="bg-[#4664A7] text-white py-1 px-2 rounded-xl">08:40 - 09:30</div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                
                <!-- Row B -->
                <div class="flex items-center">
                    <div class="w-48 min-w-[12rem] pr-4 font-medium">Information Technology B</div>
                    <div class="flex-1 overflow-x-auto">
                        <div class="schedule-row flex space-x-4 min-w-max overflow-x-auto hide-scrollbar">
                            <!-- Schedule Cards -->
                            @for ($i = 0; $i < 7; $i++)
                            <div class="schedule-card bg-[#27354C] rounded-lg p-3 w-64 border border-[#2B2C32]">
                                <div class="flex justify-between mb-2">
                                    <h4 class="font-medium">Internet of Things</h4>
                                    <div class="flex space-x-1">
                                        <button class="text-gray-400 hover:text-white">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-white">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="bg-[#2B2C32] text-sm text-white py-1 px-2 rounded mb-2 inline-block">
                                    Gedung Dieng A303
                                </div>
                                <div class="flex justify-between text-sm">
                                    <div class="bg-[#12131A] text-white py-1 px-2 rounded">2 SKS</div>
                                    <div class="bg-[#12131A] text-white py-1 px-2 rounded">08:40 - 09:30</div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                
                <!-- Row C -->
                <div class="flex items-center">
                    <div class="w-48 min-w-[12rem] pr-4 font-medium">Information Technology C</div>
                    <div class="flex-1 overflow-x-auto">
                        <div class="schedule-row flex space-x-4 min-w-max overflow-x-auto hide-scrollbar">
                            <!-- Schedule Cards -->
                            @for ($i = 0; $i < 7; $i++)
                            <div class="schedule-card bg-[#27354C] rounded-lg p-3 w-64 border border-[#2B2C32]">
                                <div class="flex justify-between mb-2">
                                    <h4 class="font-medium">Internet of Things</h4>
                                    <div class="flex space-x-1">
                                        <button class="text-gray-400 hover:text-white">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-white">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="bg-[#2B2C32] text-sm text-white py-1 px-2 rounded mb-2 inline-block">
                                    Gedung Dieng A303
                                </div>
                                <div class="flex justify-between text-sm">
                                    <div class="bg-[#12131A] text-white py-1 px-2 rounded">2 SKS</div>
                                    <div class="bg-[#12131A] text-white py-1 px-2 rounded">08:40 - 09:30</div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                
                <!-- Row D -->
                <div class="flex items-center">
                    <div class="w-48 min-w-[12rem] pr-4 font-medium">Information Technology D</div>
                    <div class="flex-1 overflow-hidden">
                        <div class="schedule-row flex space-x-4 min-w-max overflow-x-auto hide-scrollbar">
                            <!-- Schedule Cards -->
                            @for ($i = 0; $i < 7; $i++)
                            <div class="schedule-card bg-[#27354C] rounded-lg p-3 w-64 border border-[#2B2C32]">
                                <div class="flex justify-between mb-2">
                                    <h4 class="font-medium">Internet of Things</h4>
                                    <div class="flex space-x-1">
                                        <button class="text-gray-400 hover:text-white">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-white">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="bg-[#2B2C32] text-sm text-white py-1 px-2 rounded mb-2 inline-block">
                                    Gedung Dieng A303
                                </div>
                                <div class="flex justify-between text-sm">
                                    <div class="bg-[#12131A] text-white py-1 px-2 rounded">2 SKS</div>
                                    <div class="bg-[#12131A] text-white py-1 px-2 rounded">08:40 - 09:30</div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                
                <!-- Row E -->
                <div class="flex items-center">
                    <div class="w-48 min-w-[12rem] pr-4 font-medium">Information Technology E</div>
                    <div class="flex-1 overflow-hidden">
                        <div class="schedule-row flex space-x-4 min-w-max overflow-x-auto hide-scrollbar">
                            <!-- Schedule Cards -->
                            @for ($i = 0; $i < 7; $i++)
                            <div class="schedule-card bg-[#27354C] rounded-lg p-3 w-64 border border-[#2B2C32]">
                                <div class="flex justify-between mb-2">
                                    <h4 class="font-medium">Internet of Things</h4>
                                    <div class="flex space-x-1">
                                        <button class="text-gray-400 hover:text-white">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-white">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="bg-[#2B2C32] text-sm text-white py-1 px-2 rounded mb-2 inline-block">
                                    Gedung Dieng A303
                                </div>
                                <div class="flex justify-between text-sm">
                                    <div class="bg-[#12131A] text-white py-1 px-2 rounded">2 SKS</div>
                                    <div class="bg-[#12131A] text-white py-1 px-2 rounded">08:40 - 09:30</div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Computer Science Section -->
        <div>
            <div class="bg-[#12131A] text-white py-2 px-4 rounded-lg mb-2 border border-[#2B2C32]">
                <h3 class="text-lg font-medium">Computer Science</h3>
            </div>
            
            <div class="grid grid-cols-1 gap-4">
                <!-- Row A -->
                <div class="flex items-center">
                    <div class="w-48 min-w-[12rem] pr-4 font-medium">Computer Science A</div>
                    <div class="flex-1 overflow-hidden">
                        <div class="schedule-row flex space-x-4 min-w-max overflow-x-auto hide-scrollbar">
                            <!-- Schedule Cards -->
                            @for ($i = 0; $i < 7; $i++)
                            <div class="schedule-card bg-[#27354C] rounded-lg p-3 w-64 border border-[#2B2C32]">
                                <div class="flex justify-between mb-2">
                                    <h4 class="font-medium">Data Structures</h4>
                                    <div class="flex space-x-1">
                                        <button class="text-gray-400 hover:text-white">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-white">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="bg-[#2B2C32] text-sm text-white py-1 px-2 rounded mb-2 inline-block">
                                    Gedung Dieng B201
                                </div>
                                <div class="flex justify-between text-sm">
                                    <div class="bg-[#12131A] text-white py-1 px-2 rounded">3 SKS</div>
                                    <div class="bg-[#12131A] text-white py-1 px-2 rounded">10:40 - 12:10</div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</style>

<!-- Tambahkan referensi ke file JavaScript -->
<script src="{{ asset('js/schedule.js') }}"></script>
@endsection