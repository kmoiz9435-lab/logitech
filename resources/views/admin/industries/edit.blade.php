@extends('admin.layouts.admin')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-white">Edit Industry</h2>
            <p class="text-[#9CA3AF] mt-1">{{ $industry->title }}</p>
        </div>
        <a href="{{ route('admin.industries.index') }}" class="px-4 py-2 text-[#9CA3AF] hover:text-white transition-colors">Cancel</a>
    </div>

    @if($errors->any())
        <div class="admin-card rounded-xl p-4 text-sm text-red-300 mb-6 space-y-1">
            @foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.industries.update', $industry) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="admin-card rounded-xl p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title', $industry->title) }}" required class="form-input rounded-lg px-4 py-3 w-full">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Description <span class="text-red-400">*</span></label>
                <textarea name="description" rows="3" required class="form-input rounded-lg px-4 py-3 w-full">{{ old('description', $industry->description) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Icon (Font Awesome) <span class="text-red-400">*</span></label>
                    <input type="text" name="icon" value="{{ old('icon', $industry->icon) }}" required class="form-input rounded-lg px-4 py-3 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $industry->sort_order) }}" min="0" class="form-input rounded-lg px-4 py-3 w-full">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Image (optional)</label>
                @if($industry->image)
                    <img src="{{ $industry->image_url }}" alt="{{ $industry->title }}" class="h-20 w-32 object-cover rounded-lg border border-[#183B56]/40 mb-3">
                @endif
                <input type="file" name="image" accept="image/*" class="form-input rounded-lg px-4 py-2.5 w-full text-sm">
            </div>
            <label class="flex items-center gap-3 text-sm text-[#F4F6F8] cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $industry->is_active) ? 'checked' : '' }} class="custom-checkbox"> Active (site pe dikhane ke liye)
            </label>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.industries.index') }}" class="px-6 py-3 text-[#9CA3AF] hover:text-white transition-colors font-medium">Cancel</a>
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg font-semibold inline-flex items-center gap-2"><i class="fa-solid fa-floppy-disk"></i> Update Industry</button>
        </div>
    </form>
</div>
@endsection
