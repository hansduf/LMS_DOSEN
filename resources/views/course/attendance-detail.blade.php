@extends('template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-[#EBEBEB]">Detail Absensi - {{ $attendance->title }}</h1>
        <a href="{{ route('courses.attendance.all', $course) }}" class="text-blue-400 hover:text-blue-300 flex items-center">
            <i class="bi bi-arrow-left mr-2"></i>Kembali ke Daftar Absensi
        </a>
    </div>

    <div class="bg-[#1E1F25] rounded-lg p-6 shadow">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-[#EBEBEB] mb-2">Informasi Absensi</h2>
            <div class="text-gray-400">
                <p>Tanggal: {{ $attendance->created_at->format('d M Y H:i') }}</p>
                <p>Kelas: {{ $course->title }}</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-[#2B2C32]">
                        <th class="pb-3 text-[#EBEBEB]">Nama Mahasiswa</th>
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
                            <td class="py-3 text-[#EBEBEB]">{{ $submission->student->name }}</td>
                            <td class="py-3">
                                <span class="px-2 py-1 rounded text-xs font-medium
                                    @if($submission->status === 'present') bg-green-500/20 text-green-400
                                    @elseif($submission->status === 'late') bg-yellow-500/20 text-yellow-400
                                    @else bg-red-500/20 text-red-400
                                    @endif">
                                    {{ ucfirst($submission->status) }}
                                </span>
                            </td>
                            <td class="py-3 text-gray-400">{{ $submission->created_at->format('d M Y H:i') }}</td>
                            @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                                <td class="py-3">
                                    <form action="{{ route('courses.attendance.update-status', [$course, $attendance, $submission]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] rounded px-2 py-1 text-sm">
                                            <option value="present" {{ $submission->status === 'present' ? 'selected' : '' }}>Present</option>
                                            <option value="late" {{ $submission->status === 'late' ? 'selected' : '' }}>Late</option>
                                            <option value="absent" {{ $submission->status === 'absent' ? 'selected' : '' }}>Absent</option>
                                        </select>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-400">Belum ada mahasiswa yang mengisi absensi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 