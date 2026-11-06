@extends('admin.layouts.admin')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-white">Add Why Choose Us Item</h2>
            <p class="text-[#9CA3AF] mt-1">Website ke Why Choose Us section mein naya point</p>
        </div>
        <a href="{{ route('admin.why-choose.index') }}" class="px-4 py-2 text-[#9CA3AF] hover:text-white transition-colors">Cancel</a>
    </div>

    @if($errors->any())
        <div class="admin-card rounded-xl p-4 text-sm text-red-300 mb-6 space-y-1">
            @foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.why-choose.store') }}" class="space-y-6">
        @csrf
        <div class="admin-card rounded-xl p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required class="form-input rounded-lg px-4 py-3 w-full" placeholder="e.g., Precision Engineering">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Description <span class="text-red-400">*</span></label>
                <textarea name="description" rows="3" required class="form-input rounded-lg px-4 py-3 w-full">{{ old('description') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Icon (Font Awesome) <span class="text-red-400">*</span></label>
                    <input type="text" name="icon" value="{{ old('icon', 'check-circle') }}" required class="form-input rounded-lg px-4 py-3 w-full">
                    <p class="text-xs text-[#9CA3AF] mt-1">Puri list: fontawesome.com/icons</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="form-input rounded-lg px-4 py-3 w-full">
                </div>
            </div>
            <label class="flex items-center gap-3 text-sm text-[#F4F6F8] cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" checked class="custom-checkbox"> Active (site pe dikhane ke liye)
            </label>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.why-choose.index') }}" class="px-6 py-3 text-[#9CA3AF] hover:text-white transition-colors font-medium">Cancel</a>
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg font-semibold inline-flex items-center gap-2"><i class="fa-solid fa-floppy-disk"></i> Save Item</button>
        </div>
    </form>
</div>
@endsection
