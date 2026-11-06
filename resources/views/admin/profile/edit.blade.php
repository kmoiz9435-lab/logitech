@extends('admin.layouts.admin')
@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-white">Admin Profile</h2>
        <p class="text-[#9CA3AF] mt-1">Apni profile aur password manage karein</p>
    </div>

    @if(session('success'))
        <div class="admin-card rounded-xl p-4 text-sm text-[#6EE7B7] border-[#10B981]/40">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.profile.update') }}" class="admin-card rounded-xl p-6 space-y-5">
        @csrf
        @method('PUT')
        <h3 class="text-lg font-bold text-white"><i class="fa-solid fa-user text-[#D6A84B] mr-2"></i>Profile Information</h3>
        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Name <span class="text-red-400">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-input rounded-lg px-4 py-3 w-full">
                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Email <span class="text-red-400">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="form-input rounded-lg px-4 py-3 w-full">
                @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-input rounded-lg px-4 py-3 w-full">
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="btn-primary px-6 py-3 rounded-lg font-semibold inline-flex items-center gap-2"><i class="fa-solid fa-floppy-disk"></i> Save Profile</button>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.profile.password') }}" class="admin-card rounded-xl p-6 space-y-5">
        @csrf
        <h3 class="text-lg font-bold text-white"><i class="fa-solid fa-lock text-[#D6A84B] mr-2"></i>Change Password</h3>
        <div class="grid md:grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Current Password</label>
                <input type="password" name="current_password" required class="form-input rounded-lg px-4 py-3 w-full">
                @error('current_password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">New Password</label>
                <input type="password" name="password" required class="form-input rounded-lg px-4 py-3 w-full">
                @error('password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="form-input rounded-lg px-4 py-3 w-full">
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="btn-primary px-6 py-3 rounded-lg font-semibold inline-flex items-center gap-2"><i class="fa-solid fa-key"></i> Update Password</button>
        </div>
    </form>
</div>
@endsection
