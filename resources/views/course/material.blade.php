@extends('template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('courses.show', $course) }}" class="text-blue-400 hover:text-blue-300 flex items-center">
                <i class="bi bi-arrow-left mr-2"></i> Back to Course
            </a>
        </div>

        <!-- Material Details -->
        <div class="bg-[#1E1F25] rounded-lg p-6 shadow">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <div class="flex items-center text-blue-400 mb-2">
                        <i class="bi bi-file-text mr-2"></i>
                        <span class="text-sm font-medium">Material</span>
                    </div>
                    <h1 class="text-2xl font-semibold text-[#EBEBEB] mb-2">{{ $material->title }}</h1>
                    <div class="text-sm text-gray-400">
                        <i class="bi bi-clock mr-1"></i> Posted: {{ $material->created_at->format('M d, Y H:i') }}
                    </div>
                </div>
                @if(auth()->user()->teacher && auth()->user()->teacher->teacher_id === $course->teacher_id)
                    <div class="flex space-x-2">
                        <button 
                            class="text-blue-400 hover:text-blue-300 edit-material-btn"
                            data-id="{{ $material->id }}"
                            data-title="{{ $material->title }}"
                            data-description="{{ $material->description }}"
                            data-external-link="{{ $material->external_link }}"
                        >
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form action="{{ route('courses.materials.destroy', [$course, $material]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 delete-material-btn">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Material Content -->
            <div class="prose prose-invert max-w-none">
                <div class="text-[#EBEBEB] mb-6">
                    {{ $material->description }}
                </div>

                @if($material->external_link)
                    <div class="mt-6">
                        <a href="{{ $material->external_link }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                            <i class="bi bi-link-45deg mr-2"></i> View Material
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Edit Material Form -->
<div id="editMaterialForm" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-[#1E1F25] rounded-lg p-6 w-full max-w-2xl max-h-[90vh] overflow-hidden">
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

<script src="{{ asset('js/course.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize course data
        window.courseData = {
            id: "{{ $course->id }}",
            updateMaterialUrl: "{{ route('courses.materials.update', ['course' => $course->id, 'material' => ':id']) }}"
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

        // Add event listeners for delete buttons
        document.querySelectorAll('.delete-material-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to delete this material?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection 