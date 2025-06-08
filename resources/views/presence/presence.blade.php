@extends('template')

@section('content')
<div class="mt-[-20px] mr-[-33px] p-[10px] text-[#EBEBEB] transition-all duration-300 overflow-hidden">
    <!-- Attendance History -->
    <div class="bg-[#1E1F25] rounded-lg p-4 border border-[#2B2C32] mb-6 flex flex-col h-[calc(100vh-120px)]">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mr-2">
                    <i class="bi bi-calendar-check text-blue-600 text-sm"></i>
                </div>
                <span class="font-medium">Attendance History</span>
            </div>
            <button class="text-gray-400">
                <i class="bi bi-three-dots"></i>
            </button>
        </div>
        
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <select class="appearance-none bg-[#12131A] border border-[#2B2C32] rounded-lg px-4 py-2 pr-8 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm text-white">
                        <option>Select department</option>
                        <option>Information Technology</option>
                        <option>Human Resource</option>
                        <option>Marketing</option>
                        <option>Finance</option>
                        <option>Operations</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                        <i class="bi bi-chevron-down text-xs"></i>
                    </div>
                </div>
                
                <div class="flex items-center bg-[#12131A] border border-[#2B2C32] rounded-lg px-3 py-2">
                    <i class="bi bi-calendar text-gray-400 mr-2"></i>
                    <span class="text-sm">10 Feb 2025</span>
                </div>
            </div>
            
            <div class="relative">
                <div class="flex items-center bg-[#12131A] border border-[#2B2C32] rounded-lg px-3 py-2">
                    <i class="bi bi-search text-gray-400 mr-2"></i>
                    <input type="text" placeholder="Search employee" class="bg-transparent border-none focus:ring-0 text-sm w-40 text-white">
                </div>
            </div>
        </div>
        
        <!-- Table Container with Scroll -->
        <div class="overflow-auto flex-1 custom-scrollbar">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-[#1E1F25] sticky top-0">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center">
                                # ID <i class="bi bi-arrow-down-short ml-1"></i>
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Name <i class="bi bi-arrow-down-short ml-1"></i>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Department <i class="bi bi-arrow-down-short ml-1"></i>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Clock-in <i class="bi bi-arrow-down-short ml-1"></i>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Clock-out <i class="bi bi-arrow-down-short ml-1"></i>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Status <i class="bi bi-arrow-down-short ml-1"></i>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="bg-[#1E1F25] divide-y divide-gray-700">
                    <!-- Row 1 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">#E120</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-8 w-8 rounded-full mr-2" src="https://via.placeholder.com/32" alt="">
                                <div class="text-sm font-medium text-gray-200">John Doe</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Information Technology</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">08:15 AM</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">05:00 PM</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Present</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-gray-400">
                                <i class="bi bi-three-dots"></i>
                            </button>
                        </td>
                    </tr>
                    
                    <!-- Row 2 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">#E119</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-8 w-8 rounded-full mr-2" src="https://via.placeholder.com/32" alt="">
                                <div class="text-sm font-medium text-gray-200">Sarah Lee</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Human Resource</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">09:05 AM</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">05:00 PM</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Late</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-gray-400">
                                <i class="bi bi-three-dots"></i>
                            </button>
                        </td>
                    </tr>
                    
                    <!-- Row 3 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">#E118</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-8 w-8 rounded-full mr-2" src="https://via.placeholder.com/32" alt="">
                                <div class="text-sm font-medium text-gray-200">Michael Tan</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Marketing</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">08:50 AM</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">05:00 PM</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Present</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-gray-400">
                                <i class="bi bi-three-dots"></i>
                            </button>
                        </td>
                    </tr>
                    
                    <!-- Row 4 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">#E117</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-8 w-8 rounded-full mr-2" src="https://via.placeholder.com/32" alt="">
                                <div class="text-sm font-medium text-gray-200">Alice Morgan</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Finance</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">08:45 AM</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">05:00 PM</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Present</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-gray-400">
                                <i class="bi bi-three-dots"></i>
                            </button>
                        </td>
                    </tr>
                    
                    <!-- Row 5 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">#E116</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-8 w-8 rounded-full mr-2" src="https://via.placeholder.com/32" alt="">
                                <div class="text-sm font-medium text-gray-200">James Carter</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Information Technology</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">-</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">-</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Absent</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-gray-400">
                                <i class="bi bi-three-dots"></i>
                            </button>
                        </td>
                    </tr>
                    
                    <!-- Row 6 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">#E115</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-8 w-8 rounded-full mr-2" src="https://via.placeholder.com/32" alt="">
                                <div class="text-sm font-medium text-gray-200">Emma Brown</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Marketing</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">08:30 AM</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">05:05 PM</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Present</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-gray-400">
                                <i class="bi bi-three-dots"></i>
                            </button>
                        </td>
                    </tr>
                    
                    <!-- Tambahkan beberapa baris lagi untuk menunjukkan scroll -->
                    @for ($i = 0; $i < 10; $i++)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">#E{{ 114 - $i }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-8 w-8 rounded-full mr-2" src="https://via.placeholder.com/32" alt="">
                                <div class="text-sm font-medium text-gray-200">Employee {{ 114 - $i }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Information Technology</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">08:30 AM</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">05:00 PM</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Present</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-gray-400">
                                <i class="bi bi-three-dots"></i>
                            </button>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
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
@endsection