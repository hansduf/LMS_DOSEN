@extends('template')

@section('content')
<div class="flex flex-col lg:flex-row gap-6 mt-[-20px] mr-[-33px] p-[10px] text-[#EBEBEB] transition-all duration-300">
    <!-- Main Content -->
    <div class="flex-1 min-w-0">
        <!-- Materi & Tugas Section -->
        <div class="bg-[#1E1F25] rounded-lg p-6 mb-6 shadow">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold flex items-center"><i class="bi bi-journal-text mr-2"></i> Materi & Tugas</h2>
                @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                    <div class="flex gap-2">
                        <button onclick="showMaterialForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-semibold flex items-center">
                            <i class="bi bi-plus-lg mr-1"></i>Tambah Materi
                        </button>
                        <button onclick="showAssignmentForm()" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-semibold flex items-center">
                            <i class="bi bi-plus-lg mr-1"></i>Buat Tugas
                        </button>
                    </div>
                @endif
            </div>

            <!-- Material Form (Hidden by default) -->
            @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                <div id="materialForm" class="hidden mb-6">
                    <form action="{{ route('courses.materials.store', $course) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="title" class="w-full px-4 py-2 rounded bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] focus:outline-none" placeholder="Judul Materi" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="description" class="w-full px-4 py-2 rounded bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] focus:outline-none" placeholder="Deskripsi materi" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="url" name="external_link" class="w-full px-4 py-2 rounded bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] focus:outline-none" placeholder="Link materi (opsional)">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold flex items-center">
                                <i class="bi bi-plus-lg mr-2"></i>Tambah
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- Assignment Form (Hidden by default) -->
            @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                <div id="assignmentForm" class="hidden mb-6">
                    <form action="{{ route('courses.assignments.store', $course) }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <input type="text" name="title" class="w-full px-4 py-2 rounded bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] focus:outline-none" placeholder="Judul Tugas" required>
                            </div>
                            <div>
                                <textarea name="description" class="w-full px-4 py-2 rounded bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] focus:outline-none" placeholder="Deskripsi tugas" rows="3" required></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-400 mb-1">Link Lampiran (Opsional)</label>
                                <input type="url" name="attachment_link" class="w-full px-4 py-2 rounded bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] focus:outline-none" placeholder="https://...">
                                <p class="text-xs text-gray-500 mt-1">Link untuk file lampiran tugas (opsional)</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-400 mb-1">Batas Waktu</label>
                                    <input type="datetime-local" name="due_date" class="w-full px-4 py-2 rounded bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] focus:outline-none" required>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold flex items-center">
                                    <i class="bi bi-plus-lg mr-2"></i>Buat Tugas
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

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
                            @if($item['type'] === 'material')
                                <div class="p-4 rounded-lg bg-[#23242B] flex flex-col md:flex-row md:items-center md:justify-between hover:bg-[#2B2C32] transition-colors duration-200">
                                    <div>
                                        <div class="text-base font-semibold mb-1 flex items-center">
                                            <i class="bi bi-file-text mr-2 text-blue-400"></i>
                                            {{ $item['data']->title }}
                                        </div>
                                        <div class="text-sm text-gray-400 mb-1">{{ $item['data']->description }}</div>
                                        @if($item['data']->external_link)
                                            <a href="{{ $item['data']->external_link }}" target="_blank" class="text-blue-400 hover:underline text-xs flex items-center">
                                                <i class="bi bi-link-45deg mr-1"></i>Link Materi
                                            </a>
                                        @endif
                                        <div class="text-xs text-gray-400 mt-1">
                                            <i class="bi bi-clock mr-1"></i>{{ $item['data']->created_at->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                    <div class="mt-2 md:mt-0 flex gap-2">
                                        @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                                            <button 
                                                class="text-blue-400 hover:text-blue-300 edit-material-btn"
                                                data-id="{{ $item['data']->id }}"
                                                data-title="{{ $item['data']->title }}"
                                                data-description="{{ $item['data']->description }}"
                                                data-link="{{ $item['data']->external_link }}"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('courses.materials.destroy', [$course, $item['data']]) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-400 hover:text-red-300"><i class="bi bi-trash"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="p-4 rounded-lg bg-[#23242B] flex flex-col md:flex-row md:items-center md:justify-between hover:bg-[#2B2C32] transition-colors duration-200">
                                    <div>
                                        <div class="text-base font-semibold mb-1 flex items-center">
                                            <i class="bi bi-journal-text mr-2 text-green-400"></i>
                                            {{ $item['data']->title }}
                                        </div>
                                        <div class="text-sm text-gray-400 mb-1">{{ Str::limit($item['data']->description, 100) }}</div>
                                        @if($item['data']->attachment_link)
                                            <a href="{{ $item['data']->attachment_link }}" target="_blank" class="text-green-400 hover:underline text-xs flex items-center mb-1">
                                                <i class="bi bi-paperclip mr-1"></i>Lampiran Tugas
                                            </a>
                                        @endif
                                        <div class="flex items-center gap-4 text-xs text-gray-400">
                                            <span class="flex items-center"><i class="bi bi-clock mr-1"></i> {{ $item['data']->due_date->format('d M Y H:i') }}</span>
                                            <span class="flex items-center"><i class="bi bi-calendar-plus mr-1"></i> {{ $item['data']->created_at->format('d M Y H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="mt-2 md:mt-0 flex gap-2">
                                        @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                                            <button 
                                                class="text-blue-400 hover:text-blue-300 edit-assignment-btn"
                                                data-id="{{ $item['data']->id }}"
                                                data-title="{{ $item['data']->title }}"
                                                data-description="{{ $item['data']->description }}"
                                                data-link="{{ $item['data']->attachment_link }}"
                                                data-due-date="{{ $item['data']->due_date }}"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        @endif
                                        <a href="{{ route('courses.assignments.show', [$course, $item['data']]) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-semibold flex items-center">
                                            <i class="bi bi-eye mr-1"></i>Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            @endif
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
                @if(isset($showAllAttendance) && $showAllAttendance)
                    <a href="{{ route('courses.show', $course) }}" class="text-gray-400 hover:text-white flex items-center">
                        <i class="bi bi-chevron-up mr-1"></i>Minimize
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
                        @foreach($attendances->take(isset($showAllAttendance) ? null : 2) as $attendance)
                        <div class="p-4 rounded-lg bg-[#23242B] flex flex-col md:flex-row md:items-center md:justify-between hover:bg-[#2B2C32] transition-colors duration-200">
                            <div>
                                <div class="text-base font-semibold mb-1">{{ $attendance->title }}</div>
                                <div class="text-xs text-gray-400 mb-1">Tanggal: {{ $attendance->created_at->format('d M Y H:i') }}</div>
                            </div>
                            <div class="mt-2 md:mt-0 flex gap-2">
                                @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                                    <a href="{{ route('courses.attendance.show', [$course, $attendance]) }}" class="text-blue-400 hover:underline text-xs flex items-center"><i class="bi bi-eye mr-1"></i>Lihat Data</a>
                                @else
                                    <form action="{{ route('courses.attendance.submit', [$course, $attendance]) }}" method="POST">
                                        @csrf
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-semibold flex items-center"><i class="bi bi-check2 mr-1"></i>Isi Absensi</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @if(!isset($showAllAttendance) && $attendances->count() > 2)
                            <div class="text-center">
                                <a href="{{ route('courses.show', $course) }}?show=all_attendance" class="text-blue-400 hover:text-blue-300 text-sm flex items-center justify-center w-full">
                                    <i class="bi bi-chevron-down mr-1"></i>Lihat Semua Absensi ({{ $attendances->count() }})
                                </a>
                            </div>
                        @endif
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

<script>
function showMaterialForm() {
    document.getElementById('materialForm').classList.toggle('hidden');
    document.getElementById('assignmentForm').classList.add('hidden');
}

function showAssignmentForm() {
    document.getElementById('assignmentForm').classList.toggle('hidden');
    document.getElementById('materialForm').classList.add('hidden');
}

function showAllItems() {
    window.location.href = "{{ route('courses.show', $course) }}?show=all";
}

function showEditMaterialForm(id, title, description, link) {
    const form = document.getElementById('editMaterialForm');
    const formContent = document.getElementById('editMaterialFormContent');
    const titleInput = document.getElementById('editMaterialTitle');
    const descriptionInput = document.getElementById('editMaterialDescription');
    const linkInput = document.getElementById('editMaterialLink');

    formContent.action = `/courses/{{ $course->id }}/materials/${id}`;
    titleInput.value = title;
    descriptionInput.value = description;
    linkInput.value = link || '';

    form.classList.remove('hidden');
    document.getElementById('materialForm').classList.add('hidden');
    document.getElementById('assignmentForm').classList.add('hidden');
    document.getElementById('editAssignmentForm').classList.add('hidden');
}

function hideEditMaterialForm() {
    document.getElementById('editMaterialForm').classList.add('hidden');
}

function showEditAssignmentForm(id, title, description, link, dueDate) {
    const form = document.getElementById('editAssignmentForm');
    const formContent = document.getElementById('editAssignmentFormContent');
    const titleInput = document.getElementById('editAssignmentTitle');
    const descriptionInput = document.getElementById('editAssignmentDescription');
    const linkInput = document.getElementById('editAssignmentLink');
    const dueDateInput = document.getElementById('editAssignmentDueDate');

    formContent.action = `/courses/{{ $course->id }}/assignments/${id}`;
    titleInput.value = title;
    descriptionInput.value = description;
    linkInput.value = link || '';
    dueDateInput.value = dueDate;

    form.classList.remove('hidden');
    document.getElementById('materialForm').classList.add('hidden');
    document.getElementById('assignmentForm').classList.add('hidden');
    document.getElementById('editMaterialForm').classList.add('hidden');
}

function hideEditAssignmentForm() {
    document.getElementById('editAssignmentForm').classList.add('hidden');
}

document.querySelectorAll('.edit-material-btn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const title = this.dataset.title;
        const description = this.dataset.description;
        const link = this.dataset.link;
        showEditMaterialForm(id, title, description, link);
    });
});

document.querySelectorAll('.edit-assignment-btn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const title = this.dataset.title;
        const description = this.dataset.description;
        const link = this.dataset.link;
        const dueDate = this.dataset.dueDate;
        showEditAssignmentForm(id, title, description, link, dueDate);
    });
});
</script>
@endsection 