@extends('template')

@section('content')
<!-- Add meta tags for JavaScript data -->
<meta name="course-id" content="{{ $course->id }}">
<meta name="update-material-url" content="{{ route('courses.materials.update', ['course' => $course->id, 'material' => ':id']) }}">
<meta name="update-assignment-url" content="{{ route('courses.assignments.update', ['course' => $course->id, 'assignment' => ':id']) }}">

<!-- Add Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">

<div class="flex flex-col lg:flex-row gap-6 mt-6 mr-[-33px] p-[10px] text-[#EBEBEB] transition-all duration-300">
    <!-- Main Content -->
    <div class="flex-1 min-w-0">
        <!-- Materi & Tugas Section -->
        <div class="bg-[#1E1F25] rounded-lg p-6 mb-6 shadow">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold flex items-center"><i class="bi bi-journal-text mr-2"></i> Materi & Tugas</h2>
                @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                    <div class="flex gap-2">
                        <button id="showMaterialBtn" onclick="showMaterialForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-semibold flex items-center">
                            <i class="bi bi-plus-lg mr-1"></i>Tambah Materi
                        </button>
                        <button id="showAssignmentBtn" onclick="showAssignmentForm()" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-semibold flex items-center">
                            <i class="bi bi-plus-lg mr-1"></i>Buat Tugas
                        </button>
                    </div>
                @endif
            </div>

            <!-- Material Form -->
            <div id="materialForm" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm z-50 flex items-center justify-center">
                <div class="bg-[#1E1F25]/95 rounded-lg p-6 w-full max-w-2xl max-h-[90vh] overflow-hidden shadow-2xl">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-[#EBEBEB]">Add New Material</h3>
                        <button onclick="hideMaterialForm()" class="text-gray-400 hover:text-white">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <form action="{{ route('courses.materials.store', $course) }}" method="POST" class="max-h-[calc(90vh-8rem)] overflow-y-auto custom-scrollbar pr-2">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-[#EBEBEB] mb-2">Title</label>
                            <input type="text" name="title" id="title" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-[#EBEBEB] mb-2">Description</label>
                            <textarea name="description" id="description" rows="3" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="external_link" class="block text-[#EBEBEB] mb-2">External Link (Optional)</label>
                            <input type="url" name="external_link" id="external_link" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="flex justify-end space-x-2 sticky bottom-0 bg-[#1E1F25] pt-4">
                            <button type="button" onclick="hideMaterialForm()" class="px-4 py-2 text-gray-400 hover:text-gray-300">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Add Material</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit Material Form -->
            <div id="editMaterialForm" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm z-50 flex items-center justify-center">
                <div class="bg-[#1E1F25]/95 rounded-lg p-6 w-full max-w-2xl max-h-[90vh] overflow-hidden shadow-2xl">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-[#EBEBEB]">Edit Material</h3>
                        <button onclick="hideEditMaterialForm()" class="text-gray-400 hover:text-white">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <form id="editMaterialFormContent" method="POST" class="max-h-[calc(90vh-8rem)] overflow-y-auto custom-scrollbar pr-2">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="editMaterialTitle" class="block text-[#EBEBEB] mb-2">Title</label>
                            <input type="text" name="title" id="editMaterialTitle" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="editMaterialDescription" class="block text-[#EBEBEB] mb-2">Description</label>
                            <textarea name="description" id="editMaterialDescription" rows="3" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="editMaterialLink" class="block text-[#EBEBEB] mb-2">External Link (Optional)</label>
                            <input type="url" name="external_link" id="editMaterialLink" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="flex justify-end space-x-2 sticky bottom-0 bg-[#1E1F25] pt-4">
                            <button type="button" onclick="hideEditMaterialForm()" class="px-4 py-2 text-gray-400 hover:text-gray-300">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Update Material</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Assignment Form -->
            <div id="assignmentForm" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm z-50 flex items-center justify-center">
                <div class="bg-[#1E1F25]/95 rounded-lg p-6 w-full max-w-2xl max-h-[90vh] overflow-hidden shadow-2xl">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-[#EBEBEB]">Add New Assignment</h3>
                        <button type="button" onclick="hideAssignmentForm()" class="text-gray-400 hover:text-white">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <form action="{{ route('courses.assignments.store', $course) }}" method="POST" class="max-h-[calc(90vh-8rem)] overflow-y-auto custom-scrollbar pr-2" id="assignmentFormContent">
                        @csrf
                        @if(session('error'))
                            <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-2 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="mb-4">
                            <label for="assignment_title" class="block text-[#EBEBEB] mb-2">Title</label>
                            <input type="text" name="title" id="assignment_title" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="assignment_description" class="block text-[#EBEBEB] mb-2">Description</label>
                            <textarea name="description" id="assignment_description" rows="3" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="due_date" class="block text-[#EBEBEB] mb-2">Due Date</label>
                            <input type="text" name="due_date" id="due_date" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500 flatpickr-input" required>
                        </div>
                        <div class="mb-4">
                            <label for="attachment_link" class="block text-[#EBEBEB] mb-2">Attachment Link (Optional)</label>
                            <input type="url" name="attachment_link" id="attachment_link" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="flex justify-end space-x-2 sticky bottom-0 bg-[#1E1F25] pt-4">
                            <button type="button" onclick="hideAssignmentForm()" class="px-4 py-2 text-gray-400 hover:text-gray-300">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Add Assignment</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit Assignment Form -->
            <div id="editAssignmentForm" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm z-50 flex items-center justify-center">
                <div class="bg-[#1E1F25]/95 rounded-lg p-6 w-full max-w-2xl max-h-[90vh] overflow-hidden shadow-2xl">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-[#EBEBEB]">Edit Assignment</h3>
                        <button onclick="hideEditAssignmentForm()" class="text-gray-400 hover:text-white">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <form id="editAssignmentFormContent" method="POST" class="max-h-[calc(90vh-8rem)] overflow-y-auto custom-scrollbar pr-2">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="editAssignmentTitle" class="block text-[#EBEBEB] mb-2">Title</label>
                            <input type="text" name="title" id="editAssignmentTitle" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="editAssignmentDescription" class="block text-[#EBEBEB] mb-2">Description</label>
                            <textarea name="description" id="editAssignmentDescription" rows="3" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="editDueDate" class="block text-[#EBEBEB] mb-2">Due Date</label>
                            <input type="text" name="due_date" id="editDueDate" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500 flatpickr-input" required>
                        </div>
                        <div class="mb-4">
                            <label for="editAttachmentLink" class="block text-[#EBEBEB] mb-2">Attachment Link (Optional)</label>
                            <input type="url" name="attachment_link" id="editAttachmentLink" class="w-full px-4 py-2 bg-[#12131A] border border-[#2B2C32] rounded-lg text-[#EBEBEB] focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="flex justify-end space-x-2 sticky bottom-0 bg-[#1E1F25] pt-4">
                            <button type="button" onclick="hideEditAssignmentForm()" class="px-4 py-2 text-gray-400 hover:text-gray-300">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Update Assignment</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Content List with Scrollbar -->
            <div class="max-h-[600px] overflow-y-auto custom-scrollbar">
                <div class="space-y-4">
                    @if(isset($showAll) && $showAll)
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Semua Materi & Tugas</h3>
                            <a href="{{ route('courses.show', $course) }}" class="text-gray-400 hover:text-white flex items-center">
                                <i class="bi bi-chevron-up mr-1"></i>Minimize
                            </a>
                        </div>
                    @endif
                    @if($latestItems->count() > 0)
                        @foreach($latestItems as $item)
                            <div class="bg-[#1E1F25] rounded-lg p-4">
                                @if($item['type'] === 'material')
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="flex items-center text-blue-400 mb-1">
                                                <i class="bi bi-file-text mr-2"></i>
                                                <span class="text-sm font-medium">Material</span>
                                            </div>
                                            <h4 class="text-[#EBEBEB] font-medium mb-1">{{ $item['data']->title }}</h4>
                                            <p class="text-gray-400 text-sm mb-2">{{ $item['data']->description }}</p>
                                            <div class="flex space-x-4">
                                                @if($item['data']->external_link)
                                                    <a href="{{ $item['data']->external_link }}" target="_blank" class="text-blue-400 hover:text-blue-300 text-sm">
                                                        <i class="bi bi-link-45deg"></i> View Material
                                                    </a>
                                                @endif
                                                <a href="{{ route('courses.materials.show', [$course, $item['data']]) }}" class="text-blue-400 hover:text-blue-300 text-sm">
                                                    <i class="bi bi-eye"></i> View Details
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button 
                                                class="text-blue-400 hover:text-blue-300 edit-material-btn"
                                                data-id="{{ $item['data']->id }}"
                                                data-title="{{ $item['data']->title }}"
                                                data-description="{{ $item['data']->description }}"
                                                data-external-link="{{ $item['data']->external_link }}"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('courses.materials.destroy', [$course, $item['data']]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 delete-material-btn">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="flex items-center text-green-400 mb-1">
                                                <i class="bi bi-journal-text mr-2"></i>
                                                <span class="text-sm font-medium">Assignment</span>
                                            </div>
                                            <h4 class="text-[#EBEBEB] font-medium mb-1">{{ $item['data']->title }}</h4>
                                            <p class="text-gray-400 text-sm mb-2">{{ $item['data']->description }}</p>
                                            <div class="text-sm text-gray-400 mb-2">
                                                <i class="bi bi-clock"></i> Due: {{ \Carbon\Carbon::parse($item['data']->due_date)->format('M d, Y H:i') }}
                                            </div>
                                            <div class="flex space-x-4">
                                                @if($item['data']->attachment_link)
                                                    <a href="{{ $item['data']->attachment_link }}" target="_blank" class="text-green-400 hover:text-green-300 text-sm">
                                                        <i class="bi bi-link-45deg"></i> View Assignment
                                                    </a>
                                                @endif
                                                <a href="{{ route('courses.assignments.show', [$course, $item['data']]) }}" class="text-blue-400 hover:text-blue-300 text-sm">
                                                    <i class="bi bi-eye"></i> View Details
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button 
                                                class="text-green-400 hover:text-green-300 edit-assignment-btn"
                                                data-id="{{ $item['data']->id }}"
                                                data-title="{{ $item['data']->title }}"
                                                data-description="{{ $item['data']->description }}"
                                                data-due-date="{{ $item['data']->due_date }}"
                                                data-attachment-link="{{ $item['data']->attachment_link }}"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('courses.assignments.destroy', [$course, $item['data']]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 delete-assignment-btn">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        @if(!$showAll && $course->materials()->count() + $course->assignments()->count() > 2)
                            <div class="text-center">
                                <a href="{{ route('courses.items.all', $course) }}" class="text-blue-400 hover:text-blue-300 text-sm flex items-center justify-center w-full">
                                    <i class="bi bi-chevron-down mr-1"></i>Lihat Semua ({{ $course->materials()->count() + $course->assignments()->count() }})
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-gray-400 text-center py-4">Belum ada materi atau tugas.</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Absensi Section -->
        <div class="bg-[#1E1F25] rounded-lg p-6 mb-6 shadow">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold flex items-center"><i class="bi bi-clipboard-check mr-2"></i> Absensi</h2>
                @if($attendances->count() > 0)
                    <a href="{{ route('courses.attendance.all', $course) }}" class="text-blue-400 hover:text-blue-300 text-sm flex items-center">
                        <i class="bi bi-list-ul mr-1"></i>Lihat Semua
                    </a>
                @endif
            </div>
            @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                <form action="{{ route('courses.attendance.store', $course) }}" method="POST" class="mb-4">
                    @csrf
                    <div class="flex gap-2">
                        <input type="text" name="attendance_title" class="w-full px-4 py-2 rounded bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] focus:outline-none" placeholder="Judul Absensi (misal: Pertemuan 1)" required>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold flex items-center"><i class="bi bi-plus-lg mr-2"></i>Buat</button>
                    </div>
                </form>
            @endif
            <div class="max-h-[400px] overflow-y-auto custom-scrollbar">
                @if(isset($attendances) && $attendances->count())
                    <div class="space-y-4">
                        @php
                            $latestAttendance = $attendances->first();
                            $nextClassTime = \Carbon\Carbon::parse($course->start_time);
                            $currentDay = \Carbon\Carbon::now()->format('l');
                            $isClassDay = $currentDay === $course->schedule_day;
                            $isWithinTimeWindow = false;
                            
                            if ($isClassDay) {
                                $timeWindowStart = $nextClassTime->copy()->subMinutes(15);
                                $timeWindowEnd = $nextClassTime->copy()->addMinutes(30);
                                $now = \Carbon\Carbon::now();
                                $isWithinTimeWindow = $now->between($timeWindowStart, $timeWindowEnd);
                            }
                        @endphp
                        
                        <div class="p-4 rounded-lg bg-[#23242B] flex flex-col md:flex-row md:items-center md:justify-between hover:bg-[#2B2C32] transition-colors duration-200">
                            <div>
                                <div class="text-base font-semibold mb-1">{{ $latestAttendance->title }}</div>
                                <div class="text-xs text-gray-400 mb-1">Tanggal: {{ $latestAttendance->created_at->format('d M Y H:i') }}</div>
                                @if($isClassDay && $latestAttendance->created_at->isToday())
                                    <div class="text-xs {{ $isWithinTimeWindow ? 'text-green-400' : 'text-yellow-400' }} mb-1">
                                        <i class="bi bi-clock"></i> 
                                        @if($isWithinTimeWindow)
                                            Waktu absensi aktif ({{ $timeWindowStart->format('H:i') }} - {{ $timeWindowEnd->format('H:i') }})
                                        @else
                                            Jadwal absensi: {{ $course->schedule_day }}, {{ $nextClassTime->format('H:i') }}
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="mt-2 md:mt-0 flex gap-2">
                                @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                                    <a href="{{ route('courses.attendance.show', [$course, $latestAttendance]) }}" class="text-blue-400 hover:underline text-xs flex items-center"><i class="bi bi-eye mr-1"></i>Lihat Data</a>
                                @else
                                    <form action="{{ route('courses.attendance.submit', [$course, $latestAttendance]) }}" method="POST">
                                        @csrf
                                        <button 
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-semibold flex items-center {{ (!$isClassDay || !$isWithinTimeWindow || !$latestAttendance->created_at->isToday()) ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            {{ (!$isClassDay || !$isWithinTimeWindow || !$latestAttendance->created_at->isToday()) ? 'disabled' : '' }}
                                        >
                                            <i class="bi bi-check2 mr-1"></i>Isi Absensi
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-gray-400 text-center py-4">Belum ada absensi.</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="w-full lg:w-80 flex-shrink-0">
        <div class="bg-[#1E1F25] rounded-lg p-6 mb-6 shadow">
            <h3 class="text-lg font-semibold mb-4 flex items-center"><i class="bi bi-info-circle mr-2"></i> Info Kelas</h3>
            @if($course->thumbnail)
                <div class="mb-4">
                    <img src="{{ Storage::url($course->thumbnail) }}" alt="Thumbnail Kelas" class="w-full h-40 object-cover rounded-lg">
                </div>
            @endif
            <div class="space-y-2">
                <div class="flex items-center"><i class="bi bi-key text-gray-400 mr-2"></i> <span class="font-mono">{{ $course->course_code }}</span></div>
                <div class="flex items-center"><i class="bi bi-calendar-event text-gray-400 mr-2"></i> {{ $course->schedule_day }}, {{ \Carbon\Carbon::parse($course->start_time)->format('H:i') }}</div>
                <div class="flex items-center"><i class="bi bi-geo-alt text-gray-400 mr-2"></i> {{ $course->location }}</div>
                <div class="flex items-center"><i class="bi bi-palette text-gray-400 mr-2"></i> <span class="rounded px-2 py-1 text-xs bg-{{ $course->class_color }}">{{ $course->class_color }}</span></div>
                <div class="flex items-center"><i class="bi bi-collection text-gray-400 mr-2"></i> {{ $materials->count() ?? 0 }} Materi</div>
                <div class="flex items-center"><i class="bi bi-journal-text text-gray-400 mr-2"></i> {{ $assignments->count() ?? 0 }} Tugas</div>
                <div class="flex items-center"><i class="bi bi-people text-gray-400 mr-2"></i> {{ $students->count() }} Murid</div>
                <div class="flex items-center"><i class="bi bi-award text-gray-400 mr-2"></i> {{ $course->sks }} SKS ({{ $course->sks * 40 }} menit)</div>
            </div>
        </div>
        <div class="bg-[#1E1F25] rounded-lg p-6 shadow">
            <h3 class="text-lg font-semibold mb-4 flex items-center"><i class="bi bi-people mr-2"></i> Daftar Murid</h3>
            @if($students->isEmpty())
                <div class="text-gray-400">Belum ada murid yang bergabung.</div>
            @else
                <ul class="space-y-2">
                    @foreach($students as $student)
                    <li class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gray-600 flex items-center justify-center text-white font-bold">{{ strtoupper(substr($student->name,0,1)) }}</div>
                        <div>
                            <div class="font-medium">{{ $student->name }}</div>
                            <div class="text-xs text-gray-400">{{ $student->email }}</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

<style>
.custom-scrollbar::-webkit-scrollbar {
    width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #1E1F25;
    border-radius: 4px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #2B2C32;
    border-radius: 4px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #3B3C42;
}

/* Tambahan style untuk hover effect */
.hover\:bg-\[\#2B2C32\]:hover {
    background-color: #2B2C32;
}

.transition-colors {
    transition-property: background-color, border-color, color, fill, stroke;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
}
</style>

<!-- Add Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('js/course.js') }}" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Flatpickr for assignment form
        flatpickr("#due_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
            time_24hr: true,
            theme: "dark",
            locale: {
                firstDayOfWeek: 1
            }
        });

        // Initialize Flatpickr for edit assignment form
        flatpickr("#editDueDate", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            theme: "dark",
            locale: {
                firstDayOfWeek: 1
            }
        });

        // Initialize course data
        window.courseData = {
            id: "{{ $course->id }}",
            updateMaterialUrl: "{{ route('courses.materials.update', ['course' => $course->id, 'material' => ':id']) }}",
            updateAssignmentUrl: "{{ route('courses.assignments.update', ['course' => $course->id, 'assignment' => ':id']) }}"
        };

        // Add event listeners for edit buttons
        document.querySelectorAll('.edit-material-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const title = this.dataset.title;
                const description = this.dataset.description;
                const externalLink = this.dataset.externalLink;
                showEditMaterialForm(id, title, description, externalLink);
            });
        });

        document.querySelectorAll('.edit-assignment-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const title = this.dataset.title;
                const description = this.dataset.description;
                const dueDate = this.dataset.dueDate;
                const attachmentLink = this.dataset.attachmentLink;
                showEditAssignmentForm(id, title, description, dueDate, attachmentLink);
            });
        });

        // Add event listeners for create buttons
        const showMaterialBtn = document.getElementById('showMaterialBtn');
        const showAssignmentBtn = document.getElementById('showAssignmentBtn');

        if (showMaterialBtn) {
            showMaterialBtn.addEventListener('click', function(e) {
                e.preventDefault();
                showMaterialForm();
            });
        }

        if (showAssignmentBtn) {
            showAssignmentBtn.addEventListener('click', function(e) {
                e.preventDefault();
                showAssignmentForm();
            });
        }

        // Add form submission handler
        const assignmentForm = document.getElementById('assignmentFormContent');
        if (assignmentForm) {
            assignmentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form data
                const formData = new FormData(this);
                
                // Send AJAX request
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert(data.message || 'Error creating assignment');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error creating assignment');
                });
            });
        }
    });
</script>
@endsection 