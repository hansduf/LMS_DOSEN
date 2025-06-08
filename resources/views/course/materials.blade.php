@extends('template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-[#EBEBEB]">Semua Materi - {{ $course->title }}</h1>
        <a href="{{ route('courses.show', $course) }}" class="text-blue-400 hover:text-blue-300">
            <i class="bi bi-arrow-left mr-1"></i>Kembali ke Kelas
        </a>
    </div>

    <div class="space-y-4">
        @forelse($materials as $material)
            <div class="p-4 rounded-lg bg-[#23242B] flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="text-base font-semibold mb-1 flex items-center">
                        <i class="bi bi-file-text mr-2 text-blue-400"></i>
                        {{ $material->title }}
                    </div>
                    <div class="text-sm text-gray-400 mb-1">{{ $material->description }}</div>
                    @if($material->external_link)
                        <a href="{{ $material->external_link }}" target="_blank" class="text-blue-400 hover:underline text-xs flex items-center">
                            <i class="bi bi-link-45deg mr-1"></i>Link Materi
                        </a>
                    @endif
                    <div class="text-xs text-gray-400 mt-1">
                        <i class="bi bi-clock mr-1"></i>{{ $material->created_at->format('d M Y H:i') }}
                    </div>
                </div>
                <div class="mt-2 md:mt-0 flex gap-2">
                    @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                        <form action="{{ route('courses.materials.destroy', [$course, $material]) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-400 hover:text-red-300"><i class="bi bi-trash"></i></button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-gray-400 text-center py-4">Belum ada materi.</div>
        @endforelse
    </div>
</div>
@endsection 