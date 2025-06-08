@extends('template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-[#EBEBEB]">Semua Tugas - {{ $course->title }}</h1>
        <a href="{{ route('courses.show', $course) }}" class="text-blue-400 hover:text-blue-300">
            <i class="bi bi-arrow-left mr-1"></i>Kembali ke Kelas
        </a>
    </div>

    <div class="space-y-4">
        @forelse($assignments as $assignment)
            <div class="p-4 rounded-lg bg-[#23242B] flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="text-base font-semibold mb-1 flex items-center">
                        <i class="bi bi-journal-text mr-2 text-green-400"></i>
                        {{ $assignment->title }}
                    </div>
                    <div class="text-sm text-gray-400 mb-1">{{ Str::limit($assignment->description, 100) }}</div>
                    @if($assignment->attachment_link)
                        <a href="{{ $assignment->attachment_link }}" target="_blank" class="text-green-400 hover:underline text-xs flex items-center mb-1">
                            <i class="bi bi-paperclip mr-1"></i>Lampiran Tugas
                        </a>
                    @endif
                    <div class="flex items-center gap-4 text-xs text-gray-400">
                        <span class="flex items-center"><i class="bi bi-clock mr-1"></i> {{ $assignment->due_date->format('d M Y H:i') }}</span>
                        <span class="flex items-center"><i class="bi bi-calendar-plus mr-1"></i> {{ $assignment->created_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
                <div class="mt-2 md:mt-0 flex gap-2">
                    <a href="{{ route('courses.assignments.show', [$course, $assignment]) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-semibold flex items-center">
                        <i class="bi bi-eye mr-1"></i>Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <div class="text-gray-400 text-center py-4">Belum ada tugas.</div>
        @endforelse
    </div>
</div>
@endsection 