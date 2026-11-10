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
            <div class="admin-card rounded-xl overflow-hidden flex flex-col group">
                {{-- Clickable Image Box with Zoom Hover Effect --}}
                <div class="relative aspect-[4/3] bg-[#0F1928] overflow-hidden cursor-pointer" onclick="openGalleryModal('{{ $image->image_url }}', '{{ addslashes($image->title ?: 'Gallery Image') }}', {{ $image->is_active ? 'true' : 'false' }})" title="Click to preview full image">
                    <img src="{{ $image->image_url }}" alt="{{ $image->alt }}" class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-110">

                    {{-- High Contrast Active Status Badge --}}
                    <span class="absolute top-2.5 left-2.5 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-[#0B1521]/95 text-white border border-[#183B56] shadow-lg backdrop-blur-sm z-10 pointer-events-none">
                        <span class="w-2 h-2 rounded-full {{ $image->is_active ? 'bg-emerald-400 shadow-[0_0_8px_#34D399]' : 'bg-gray-400' }}"></span>
                        <span>{{ $image->is_active ? 'Active' : 'Inactive' }}</span>
                    </span>
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

    {{-- Image Preview Lightbox Modal --}}
    <div id="galleryImageModal" class="fixed inset-0 z-50 hidden bg-black/90 backdrop-blur-md items-center justify-center p-4 transition-opacity duration-300 opacity-0" onclick="closeGalleryModal(event)">
        <div class="relative max-w-4xl w-full bg-[#0F1928] border border-[#183B56] rounded-2xl overflow-hidden shadow-2xl transform scale-95 transition-transform duration-300" id="galleryModalBox" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between px-6 py-4 border-b border-[#183B56]/50 bg-[#0B1521]">
                <div class="flex items-center gap-3">
                    <h3 id="modalImageTitle" class="text-base font-bold text-white truncate max-w-md">Gallery Image</h3>
                    <span id="modalImageStatus" class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#0B1521] border border-[#183B56]"></span>
                </div>
                <button type="button" onclick="closeGalleryModal()" class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 text-[#9CA3AF] hover:text-white flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <div class="p-4 bg-[#070D16] flex items-center justify-center max-h-[75vh] overflow-hidden">
                <img id="modalImageEl" src="" alt="" class="max-h-[70vh] w-auto max-w-full object-contain rounded-lg shadow-lg">
            </div>
            <div class="px-6 py-3 border-t border-[#183B56]/50 bg-[#0B1521] flex justify-between items-center text-xs text-[#9CA3AF]">
                <span>Click outside ya <kbd class="px-1.5 py-0.5 bg-white/10 rounded text-white font-mono">ESC</kbd> dabayein band karne ke liye</span>
                <a id="modalImageDownload" href="" target="_blank" class="text-[#D6A84B] hover:underline flex items-center gap-1.5 font-semibold">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Full Original Image
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Delete this image? This action cannot be undone.')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    function openGalleryModal(url, title, isActive) {
        const modal = document.getElementById('galleryImageModal');
        const modalBox = document.getElementById('galleryModalBox');
        const img = document.getElementById('modalImageEl');
        const titleEl = document.getElementById('modalImageTitle');
        const statusEl = document.getElementById('modalImageStatus');
        const downloadLink = document.getElementById('modalImageDownload');

        img.src = url;
        img.alt = title;
        titleEl.textContent = title;
        downloadLink.href = url;

        if (isActive) {
            statusEl.innerHTML = '<span class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_8px_#34D399]"></span><span class="text-white text-xs">Active</span>';
        } else {
            statusEl.innerHTML = '<span class="w-2 h-2 rounded-full bg-gray-400"></span><span class="text-white text-xs">Inactive</span>';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
            modalBox.classList.remove('scale-95');
            modalBox.classList.add('scale-100');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeGalleryModal(event) {
        if (event && event.target && event.target.id !== 'galleryImageModal' && !event.target.closest('button')) {
            return;
        }
        const modal = document.getElementById('galleryImageModal');
        const modalBox = document.getElementById('galleryModalBox');
        if (!modal) return;

        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        modalBox.classList.remove('scale-100');
        modalBox.classList.add('scale-95');

        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.getElementById('modalImageEl').src = '';
            document.body.style.overflow = '';
        }, 200);
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeGalleryModal();
        }
    });
</script>
@endsection
