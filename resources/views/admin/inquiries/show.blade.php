@extends('admin.layouts.admin')
@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Inquiry Details</h2>
            <p class="text-[#9CA3AF] mt-1">{{ $inquiry->created_at->format('d M Y, H:i') }}</p>
        </div>
        <a href="{{ route('admin.inquiries.index') }}" class="px-4 py-2 text-[#9CA3AF] hover:text-white transition-colors">Back to Inquiries</a>
    </div>

    @if(session('success'))
        <div class="admin-card rounded-xl p-4 text-sm text-[#6EE7B7] border-[#10B981]/40">{{ session('success') }}</div>
    @endif

    <div class="grid md:grid-cols-3 gap-6">
        <div class="md:col-span-2 admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-4">Message</h3>
            <p class="text-[#F4F6F8]/80 text-sm leading-relaxed whitespace-pre-line">{{ $inquiry->message ?: 'No message provided.' }}</p>

            <h3 class="text-lg font-bold text-white mt-8 mb-4">Status</h3>
            <form method="POST" action="{{ route('admin.inquiries.update-status', $inquiry) }}" class="flex gap-3 flex-wrap">
                @csrf
                <select name="status" class="form-input rounded-lg px-4 py-2.5 text-sm">
                    @foreach(\App\Models\Inquiry::STATUSES as $key => $label)
                        <option value="{{ $key }}" {{ $inquiry->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary px-5 py-2.5 rounded-lg font-semibold text-sm">Update Status</button>
            </form>
        </div>

        <div class="admin-card rounded-xl p-6 space-y-4 text-sm">
            <h3 class="text-lg font-bold text-white">Contact</h3>
            <div>
                <div class="text-xs text-[#9CA3AF]">Name</div>
                <div class="font-semibold text-white">{{ $inquiry->name }}</div>
            </div>
            <div>
                <div class="text-xs text-[#9CA3AF]">Company</div>
                <div class="text-[#F4F6F8]/80">{{ $inquiry->company_name ?: '&mdash;' }}</div>
            </div>
            <div>
                <div class="text-xs text-[#9CA3AF]">Email</div>
                <a href="mailto:{{ $inquiry->email }}" class="text-[#D6A84B] hover:underline break-all">{{ $inquiry->email }}</a>
            </div>
            <div>
                <div class="text-xs text-[#9CA3AF]">Phone</div>
                <a href="tel:{{ $inquiry->phone }}" class="text-[#D6A84B] hover:underline">{{ $inquiry->phone }}</a>
            </div>
            <div>
                <div class="text-xs text-[#9CA3AF]">Product</div>
                <div class="text-[#F4F6F8]/80">{{ $inquiry->product?->name ?: '&mdash;' }}</div>
            </div>
            <div>
                <div class="text-xs text-[#9CA3AF]">Source</div>
                <div class="text-[#F4F6F8]/80">{{ ucfirst($inquiry->source ?: 'website') }}</div>
            </div>
            <div>
                <div class="text-xs text-[#9CA3AF]">IP Address</div>
                <div class="text-[#F4F6F8]/80">{{ $inquiry->ip_address ?: '&mdash;' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
