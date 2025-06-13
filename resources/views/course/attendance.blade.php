@extends('template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-[#EBEBEB]">Semua Absensi - {{ $course->title }}</h1>
        <a href="{{ route('courses.show', $course) }}" class="text-blue-400 hover:text-blue-300 flex items-center">
            <i class="bi bi-arrow-left mr-2"></i>Kembali ke Kelas
        </a>
    </div>

    <div class="bg-[#1E1F25] rounded-lg p-6 shadow">
        @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
            <form action="{{ route('courses.attendance.store', $course) }}" method="POST" class="mb-6">
                @csrf
                <div class="flex gap-2">
                    <input type="text" name="attendance_title" class="w-full px-4 py-2 rounded bg-[#23242B] border border-[#2B2C32] text-[#EBEBEB] focus:outline-none" placeholder="Judul Absensi (misal: Pertemuan 1)" required>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold flex items-center"><i class="bi bi-plus-lg mr-2"></i>Buat</button>
                </div>
            </form>
        @endif

        <div class="max-h-[calc(100vh-300px)] overflow-y-auto custom-scrollbar pr-2">
            @if($attendances->count() > 0)
                <div class="space-y-4">
                    @php
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

                    @foreach($attendances as $attendance)
                        <div class="p-4 rounded-lg bg-[#23242B] flex flex-col md:flex-row md:items-center md:justify-between hover:bg-[#2B2C32] transition-colors duration-200">
                            <div>
                                <div class="text-base font-semibold mb-1">{{ $attendance->title }}</div>
                                <div class="text-xs text-gray-400 mb-1">Tanggal: {{ $attendance->created_at->format('d M Y H:i') }}</div>
                                @if($isClassDay && $attendance->created_at->isToday())
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
                                    <a href="{{ route('courses.attendance.show', [$course, $attendance]) }}" class="text-blue-400 hover:underline text-xs flex items-center"><i class="bi bi-eye mr-1"></i>Lihat Data</a>
                                @else
                                    <form action="{{ route('courses.attendance.submit', [$course, $attendance]) }}" method="POST">
                                        @csrf
                                        <button 
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-semibold flex items-center {{ (!$isClassDay || !$isWithinTimeWindow || !$attendance->created_at->isToday()) ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            {{ (!$isClassDay || !$isWithinTimeWindow || !$attendance->created_at->isToday()) ? 'disabled' : '' }}
                                        >
                                            <i class="bi bi-check2 mr-1"></i>Isi Absensi
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-gray-400 text-center py-4">Belum ada absensi.</div>
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
</style>
@endsection 