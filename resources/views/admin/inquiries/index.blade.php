@extends('admin.layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white">Customer Inquiries</h2>
            <p class="text-[#9CA3AF] mt-1">Website contact form se aayi inquiries</p>
        </div>
    </div>

    @if(session('success'))
        <div class="admin-card rounded-xl p-4 text-sm text-[#6EE7B7] border-[#10B981]/40">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        @foreach(\App\Models\Inquiry::STATUSES as $key => $label)
            <a href="{{ route('admin.inquiries.index', ['status' => $key]) }}" class="admin-card rounded-xl p-4 text-center hover:border-[#D6A84B]/30 transition-colors {{ $status === $key ? 'border-[#D6A84B]/50' : '' }}">
                <div class="text-2xl font-extrabold text-[#D6A84B]">{{ $statusCounts[$key] ?? 0 }}</div>
                <div class="text-xs text-[#9CA3AF] mt-1">{{ $label }}</div>
            </a>
        @endforeach
    </div>

    <div class="admin-card rounded-xl p-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Search</label>
                <input type="text" name="q" value="{{ $search }}" placeholder="Name, email, phone..." class="form-input rounded-lg px-4 py-2 w-full">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Status</label>
                <select name="status" class="form-input rounded-lg px-4 py-2 w-full">
                    <option value="">All Status</option>
                    @foreach(\App\Models\Inquiry::STATUSES as $key => $label)
                        <option value="{{ $key }}" {{ $status === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Product</label>
                <select name="product" class="form-input rounded-lg px-4 py-2 w-full">
                    <option value="">All Products</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ (int) $productId === $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="btn-primary px-5 py-2.5 rounded-lg font-semibold text-sm">Filter</button>
                <a href="{{ route('admin.inquiries.index') }}" class="px-4 py-2.5 text-[#9CA3AF] hover:text-white text-sm">Reset</a>
            </div>
        </form>
    </div>

    <div class="admin-card rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-[#9CA3AF] text-xs uppercase tracking-wider border-b border-[#183B56]/40">
                        <th class="px-5 py-3">Name</th>
                        <th class="px-5 py-3">Contact</th>
                        <th class="px-5 py-3">Product</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Date</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                        <tr class="border-b border-[#183B56]/20 hover:bg-[#183B56]/10 transition-colors">
                            <td class="px-5 py-3">
                                <div class="font-semibold text-white">{{ $inquiry->name }}</div>
                                <div class="text-xs text-[#9CA3AF]">{{ $inquiry->company_name ?: '&mdash;' }}</div>
                            </td>
                            <td class="px-5 py-3">
                                <div class="text-[#F4F6F8]/80">{{ $inquiry->email }}</div>
                                <div class="text-xs text-[#9CA3AF]">{{ $inquiry->phone }}</div>
                            </td>
                            <td class="px-5 py-3 text-[#F4F6F8]/80">{{ $inquiry->product?->name ?: '&mdash;' }}</td>
                            <td class="px-5 py-3">
                                @php
                                    $badge = match ($inquiry->status) {
                                        'new' => 'badge-featured',
                                        'in_progress' => 'badge-category',
                                        'contacted' => 'badge-category',
                                        'converted' => 'badge-active',
                                        default => 'badge-inactive',
                                    };
                                @endphp
                                <span class="badge {{ $badge }}">{{ $inquiry->status_label }}</span>
                            </td>
                            <td class="px-5 py-3 text-xs text-[#9CA3AF]">{{ $inquiry->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-5 py-3 text-right">
                                <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="p-2 inline-block text-[#9CA3AF] hover:text-[#3B82F6] transition-colors" title="View"><i class="fa-solid fa-eye text-sm"></i></a>
                                <button onclick="confirmDelete({{ $inquiry->id }})" class="p-2 text-[#9CA3AF] hover:text-red-400 transition-colors" title="Delete"><i class="fa-solid fa-trash text-sm"></i></button>
                                <form id="delete-form-{{ $inquiry->id }}" action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="hidden">
                                    @csrf @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <i class="fa-solid fa-inbox text-4xl text-[#9CA3AF] mb-3 block"></i>
                                <span class="text-[#9CA3AF]">No inquiries found</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $inquiries->links() }}</div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Delete this inquiry?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection
