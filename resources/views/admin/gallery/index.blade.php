@extends('admin.layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white">Gallery</h2>
            <p class="text-[#9CA3AF] mt-1">Home page ke "Machinery Gallery" section ki images yahan se manage karein</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold text-sm inline-flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Upload Image
        </a>
    </div>

    @if(session('success'))
        <div class="admin-card rounded-xl p-4 text-sm text-[#6EE7B7] border-[#10B981]/40">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        @forelse($gallery as $image)
            <div class="admin-card rounded-xl overflow-hidden flex flex-col">
                <div class="relative aspect-[4/3] bg-[#0F1928]">
                    <img src="{{ $image->image_url }}" alt="{{ $image->alt }}" class="w-full h-full object-cover">
                    <span class="absolute top-2 left-2 badge {{ $image->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $image->is_active ? 'Active' : 'Inactive' }}</span>
                </div>
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="font-bold text-white text-sm mb-1 line-clamp-2">{{ $image->title ?: 'Untitled' }}</h3>
                    <p class="text-xs text-[#9CA3AF] mb-3 flex-grow">Sort: {{ $image->sort_order }}</p>
                    <div class="flex gap-2 justify-end">
                        <a href="{{ route('admin.gallery.edit', $image) }}" class="p-2 text-[#9CA3AF] hover:text-[#3B82F6] transition-colors" title="Edit"><i class="fa-solid fa-pencil text-sm"></i></a>
                        <button onclick="confirmDelete({{ $image->id }})" class="p-2 text-[#9CA3AF] hover:text-red-400 transition-colors" title="Delete"><i class="fa-solid fa-trash text-sm"></i></button>
                        <form id="delete-form-{{ $image->id }}" action="{{ route('admin.gallery.destroy', $image) }}" method="POST" class="hidden">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <i class="fa-solid fa-images text-5xl text-[#9CA3AF] mb-4"></i>
                <h3 class="text-xl font-medium text-white mb-2">No images yet</h3>
                <p class="text-[#9CA3AF] mb-6">Upload images to show them in the gallery</p>
                <a href="{{ route('admin.gallery.create') }}" class="btn-primary px-6 py-3 rounded-lg font-medium inline-flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Upload Image
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-6">{{ $gallery->links() }}</div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Delete this image? This action cannot be undone.')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection
