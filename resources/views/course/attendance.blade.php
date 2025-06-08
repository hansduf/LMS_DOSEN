@extends('template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-[#EBEBEB]">{{ $attendance->title }}</h1>
        <a href="{{ route('courses.show', $course) }}" class="text-blue-400 hover:text-blue-300 flex items-center">
            <i class="bi bi-arrow-left mr-2"></i> Kembali ke Kelas
        </a>
    </div>

    <div class="bg-[#1E1F25] rounded-lg p-6 shadow">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-[#EBEBEB] mb-4">Detail Absensi</h2>
            <div class="grid grid-cols-2 gap-4 text-[#EBEBEB]">
                <div>
                    <p class="text-gray-400">Tanggal Dibuat</p>
                    <p>{{ $attendance->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-400">Total Peserta</p>
                    <p>{{ $submissions->count() }} dari {{ $course->students->count() }} murid</p>
                </div>
                <div>
                    <p class="text-gray-400">Batas Waktu</p>
                    <p>{{ $attendance->created_at->addMinutes(30)->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <div class="max-h-[600px] overflow-y-auto custom-scrollbar">
                <table class="w-full">
                    <thead class="sticky top-0 bg-[#1E1F25] z-10">
                        <tr class="text-left border-b border-[#2B2C32]">
                            <th class="pb-3 text-[#EBEBEB]">Nama Murid</th>
                            <th class="pb-3 text-[#EBEBEB]">Status</th>
                            <th class="pb-3 text-[#EBEBEB]">Waktu Submit</th>
                            @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                                <th class="pb-3 text-[#EBEBEB]">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr class="border-b border-[#2B2C32]">
                                <td class="py-3 text-[#EBEBEB]">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gray-600 flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($submission->student->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-medium">{{ $submission->student->name }}</div>
                                            <div class="text-sm text-gray-400">{{ $submission->student->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="px-2 py-1 rounded text-xs font-medium
                                        @if($submission->status === 'present') bg-green-500/20 text-green-400
                                        @elseif($submission->status === 'late') bg-yellow-500/20 text-yellow-400
                                        @else bg-red-500/20 text-red-400 @endif">
                                        {{ ucfirst($submission->status) }}
                                    </span>
                                </td>
                                <td class="py-3 text-[#EBEBEB]">{{ $submission->created_at->format('d M Y H:i') }}</td>
                                @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                                    <td class="py-3">
                                        <div class="flex items-center gap-2">
                                            <form action="{{ route('courses.attendance.update-status', [$course, $attendance, $submission]) }}" method="POST" class="flex gap-2">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] rounded px-2 py-1 text-sm">
                                                    <option value="present" {{ $submission->status === 'present' ? 'selected' : '' }}>Hadir</option>
                                                    <option value="late" {{ $submission->status === 'late' ? 'selected' : '' }}>Terlambat</option>
                                                    <option value="absent" {{ $submission->status === 'absent' ? 'selected' : '' }}>Alpha</option>
                                                </select>
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                                                    Update
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-400">Belum ada yang mengisi absensi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
</style>
@endsection 