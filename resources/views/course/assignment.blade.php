@extends('template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-[#EBEBEB]">{{ $assignment->title }}</h1>
        <a href="{{ route('courses.show', $course) }}" class="text-blue-400 hover:text-blue-300 flex items-center">
            <i class="bi bi-arrow-left mr-2"></i> Kembali ke Kelas
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Assignment Details -->
        <div class="lg:col-span-2">
            <div class="bg-[#1E1F25] rounded-lg p-6 shadow mb-6">
                <h2 class="text-lg font-semibold text-[#EBEBEB] mb-4">Detail Tugas</h2>
                <div class="prose prose-invert max-w-none">
                    <p class="text-[#EBEBEB]">{{ $assignment->description }}</p>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-4 text-[#EBEBEB]">
                    <div>
                        <p class="text-gray-400">Batas Waktu</p>
                        <p>{{ $assignment->due_date->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Total Poin</p>
                        <p>{{ $assignment->total_points }} poin</p>
                    </div>
                </div>
            </div>

            <!-- Student Submission Form -->
            @if(!auth()->user()->teacher && !$studentSubmission && $assignment->due_date > now())
                <div class="bg-[#1E1F25] rounded-lg p-6 shadow">
                    <h2 class="text-lg font-semibold text-[#EBEBEB] mb-4">Kumpulkan Tugas</h2>
                    <form action="{{ route('courses.assignments.submit', [$course, $assignment]) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-[#EBEBEB] mb-2">Link Pengumpulan</label>
                            <input type="url" name="submission_link" class="w-full px-4 py-2 rounded bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] focus:outline-none" placeholder="https://..." required>
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold">Kumpulkan</button>
                    </form>
                </div>
            @endif

            <!-- Student's Submission -->
            @if($studentSubmission)
                <div class="bg-[#1E1F25] rounded-lg p-6 shadow mt-6">
                    <h2 class="text-lg font-semibold text-[#EBEBEB] mb-4">Pengumpulan Anda</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-gray-400">Link Pengumpulan</p>
                            <a href="{{ $studentSubmission->submission_link }}" target="_blank" class="text-blue-400 hover:underline">{{ $studentSubmission->submission_link }}</a>
                        </div>
                        <div>
                            <p class="text-gray-400">Waktu Pengumpulan</p>
                            <p class="text-[#EBEBEB]">{{ $studentSubmission->submitted_at->format('d M Y H:i') }}</p>
                        </div>
                        @if($studentSubmission->score !== null)
                            <div>
                                <p class="text-gray-400">Nilai</p>
                                <p class="text-[#EBEBEB]">{{ $studentSubmission->score }}/{{ $assignment->total_points }}</p>
                            </div>
                            @if($studentSubmission->feedback)
                                <div>
                                    <p class="text-gray-400">Feedback</p>
                                    <p class="text-[#EBEBEB]">{{ $studentSubmission->feedback }}</p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Submissions List (Teacher Only) -->
        @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
            <div class="lg:col-span-1">
                <div class="bg-[#1E1F25] rounded-lg p-6 shadow">
                    <h2 class="text-lg font-semibold text-[#EBEBEB] mb-4">Daftar Pengumpulan</h2>
                    <div class="max-h-[600px] overflow-y-auto custom-scrollbar">
                        @forelse($submissions as $submission)
                            <div class="border-b border-[#2B2C32] py-4 last:border-0">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-full bg-gray-600 flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($submission->student->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-[#EBEBEB]">{{ $submission->student->name }}</div>
                                        <div class="text-sm text-gray-400">{{ $submission->submitted_at->format('d M Y H:i') }}</div>
                                    </div>
                                </div>
                                <a href="{{ $submission->submission_link }}" target="_blank" class="text-blue-400 hover:underline text-sm block mb-2">{{ $submission->submission_link }}</a>
                                <form action="{{ route('courses.assignments.grade', [$course, $assignment, $submission]) }}" method="POST" class="space-y-2">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <input type="number" name="score" value="{{ $submission->score }}" min="0" max="{{ $assignment->total_points }}" class="w-full px-3 py-1 rounded bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] text-sm" placeholder="Nilai">
                                    </div>
                                    <div>
                                        <textarea name="feedback" class="w-full px-3 py-1 rounded bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] text-sm" placeholder="Feedback" rows="2">{{ $submission->feedback }}</textarea>
                                    </div>
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">Update Nilai</button>
                                </form>
                            </div>
                        @empty
                            <div class="text-gray-400 text-center py-4">Belum ada yang mengumpulkan tugas</div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
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
</style>
@endsection 