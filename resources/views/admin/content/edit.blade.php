@extends('admin.layouts.admin')
@section('content')
@php
    $titles = [
        'hero' => 'Hero Banner',
        'about' => 'About Us',
        'products' => 'Products Section',
        'industries' => 'Industries Section',
        'why_choose' => 'Why Choose Us Section',
        'gallery' => 'Gallery Section',
        'cta' => 'CTA Banner',
        'contact' => 'Contact Section',
    ];
@endphp
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white">Website Content</h2>
            <p class="text-[#9CA3AF] mt-1">Home page ki har section ki heading, text aur image yahan se edit karein</p>
        </div>
        <button type="submit" form="content-form" class="btn-primary px-6 py-3 rounded-xl font-semibold text-sm inline-flex items-center gap-2 cursor-pointer">
            <i class="fa-solid fa-floppy-disk"></i> Save Content
        </button>
    </div>

    @if(session('success'))
        <div class="admin-card rounded-xl p-4 text-sm text-[#6EE7B7] border-[#10B981]/40">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="admin-card rounded-xl p-4 text-sm text-red-300 space-y-1">
            @foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach
        </div>
    @endif

    <div class="flex flex-wrap gap-2">
        @foreach($titles as $key => $title)
            <a href="#section-{{ $key }}" class="px-4 py-2 rounded-lg text-xs font-semibold bg-[#183B56]/40 text-[#F4F6F8]/80 hover:text-white hover:bg-[#183B56]/70 border border-[#183B56]/40 transition-colors">{{ $title }}</a>
        @endforeach
    </div>

    <form id="content-form" method="POST" action="{{ route('admin.content.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        @foreach($sections as $key => $section)
            <div id="section-{{ $key }}" class="admin-card rounded-xl p-6">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-lg font-bold text-white"><i class="fa-solid fa-layer-group text-[#D6A84B] mr-2"></i>{{ $titles[$key] ?? ucfirst($key) }}</h3>
                    <span class="text-xs text-[#9CA3AF] uppercase tracking-wider">{{ $key }}</span>
                </div>
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Eyebrow / Small Label</label>
                        <input type="text" name="sections[{{ $key }}][eyebrow]" value="{{ old("sections.$key.eyebrow", $section->eyebrow) }}" class="form-input rounded-lg px-4 py-3 w-full">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Heading</label>
                        <input type="text" name="sections[{{ $key }}][heading]" value="{{ old("sections.$key.heading", $section->heading) }}" class="form-input rounded-lg px-4 py-3 w-full">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Sub Heading</label>
                        <input type="text" name="sections[{{ $key }}][sub_heading]" value="{{ old("sections.$key.sub_heading", $section->sub_heading) }}" class="form-input rounded-lg px-4 py-3 w-full">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Content / Description</label>
                        <textarea name="sections[{{ $key }}][content]" rows="4" class="form-input rounded-lg px-4 py-3 w-full">{{ old("sections.$key.content", $section->content) }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Image</label>
                        <div class="flex items-center gap-5 flex-wrap">
                            @if($section->image)
                                <img src="{{ media_url($section->image) }}" alt="{{ $titles[$key] ?? $key }}" class="h-20 w-32 object-cover rounded-lg border border-[#183B56]/40">
                            @endif
                            <input type="file" name="sections[{{ $key }}][image]" accept="image/*" class="form-input rounded-lg px-4 py-2.5 text-sm flex-1 min-w-[220px]">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="flex justify-end gap-4 pb-6">
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 text-[#9CA3AF] hover:text-white transition-colors font-medium">Cancel</a>
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg font-semibold inline-flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Save Content
            </button>
        </div>
    </form>
</div>
@endsection
