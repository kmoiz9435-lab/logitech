@extends('admin.layouts.admin')

@section('content')
<!-- Dashboard -->
<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
        <!-- Total Products -->
        <div class="stat-card rounded-xl p-6 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="stat-icon bg-[#183B56]/30">
                    <i class="fa-solid fa-cubes text-[#D6A84B] text-xl"></i>
                </div>
                <div class="text-xs text-[#9CA3AF] font-medium">Total Products</div>
            </div>
            <div class="text-3xl font-bold text-white mb-2">{{ $stats['total_products'] }}</div>
            <div class="text-xs text-[#9CA3AF]">
                <span class="text-[#D6A84B]">{{ $stats['active_products'] }}</span> active, <span class="text-[#EF4444]">{{ $stats['inactive_products'] }}</span> inactive
            </div>
        </div>

        <!-- Active Products -->
        <div class="stat-card rounded-xl p-6 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="stat-icon bg-[#183B56]/30">
                    <i class="fa-solid fa-check-circle text-green-400 text-xl"></i>
                </div>
                <div class="text-xs text-[#9CA3AF] font-medium">Active Products</div>
            </div>
            <div class="text-3xl font-bold text-white mb-2">{{ $stats['active_products'] }}</div>
            <div class="text-xs text-[#9CA3AF]">Visible on website</div>
        </div>

        <!-- Categories -->
        <div class="stat-card rounded-xl p-6 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="stat-icon bg-[#183B56]/30">
                    <i class="fa-solid fa-folder text-[#3B82F6] text-xl"></i>
                </div>
                <div class="text-xs text-[#9CA3AF] font-medium">Categories</div>
            </div>
            <div class="text-3xl font-bold text-white mb-2">{{ $stats['categories'] }}</div>
            <div class="text-xs text-[#9CA3AF]">Product categories</div>
        </div>

        <!-- Inquiries -->
        <div class="stat-card rounded-xl p-6 relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="stat-icon bg-[#183B56]/30">
                    <i class="fa-solid fa-envelope text-[#8B5CF6] text-xl"></i>
                </div>
                <div class="text-xs text-[#9CA3AF] font-medium">Total Inquiries</div>
            </div>
            <div class="text-3xl font-bold text-white mb-2">{{ $stats['inquiries'] }}</div>
            <div class="text-xs text-[#9CA3AF]">
                <span class="text-[#D6A84B]">{{ $stats['new_inquiries'] }}</span> new, <span class="text-[#3B82F6]">{{ $stats['inquiries'] - $stats['new_inquiries'] }}</span> processed
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activity -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Weekly Activity Chart -->
        <div class="xl:col-span-1 admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold mb-4 text-white">Weekly Activity</h3>
            <div class="space-y-4">
                @foreach($activity as $day)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="text-xs font-medium text-[#9CA3AF] w-12">{{ $day['label'] }}</div>
                            <div class="flex-1">
                                <div class="h-2 bg-[#183B56]/30 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#D6A84B] rounded-full" style="width: {{ $day['count'] / $maxActivity * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-xs font-bold text-[#F4F6F8]">{{ $day['count'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Products -->
        <div class="xl:col-span-2 admin-card rounded-xl p-6">
            <h3 class="text-lg font-bold mb-4 text-white">Recent Products</h3>
            <div class="space-y-3">
                @foreach($recentProducts as $product)
                    <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-[#183B56]/20 transition-colors cursor-pointer">
                        <img src="{{ $product->main_image ? asset('uploads/'.$product->main_image) : asset('assets/images/placeholder.svg') }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover">
                        <div class="flex-1 min-w-0">
                            <div class="font-medium text-white truncate">{{ $product->name }}</div>
                            <div class="text-xs text-[#9CA3AF] truncate">{{ $product->category?->name }}</div>
                        </div>
                        <div class="text-xs {{ $product->is_active ? 'text-green-400' : 'text-red-400' }} font-medium">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </div>
                        <div class="text-xs text-[#9CA3AF]">{{ $product->created_at->diffForHumans() }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="admin-card rounded-xl p-6">
        <h3 class="text-lg font-bold mb-4 text-white">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.products.create') }}" class="flex flex-col items-center p-4 rounded-lg bg-[#183B56]/20 hover:bg-[#183B56]/30 transition-colors group cursor-pointer">
                <i class="fa-solid fa-plus text-2xl text-[#D6A84B] mb-2 group-hover:scale-110 transition-transform"></i>
                <span class="text-sm font-medium text-white">Add Product</span>
            </a>

            <a href="{{ route('admin.categories.create') }}" class="flex flex-col items-center p-4 rounded-lg bg-[#183B56]/20 hover:bg-[#183B56]/30 transition-colors group cursor-pointer">
                <i class="fa-solid fa-folder-plus text-2xl text-[#3B82F6] mb-2 group-hover:scale-110 transition-transform"></i>
                <span class="text-sm font-medium text-white">Add Category</span>
            </a>

            <a href="{{ route('admin.industries.create') }}" class="flex flex-col items-center p-4 rounded-lg bg-[#183B56]/20 hover:bg-[#183B56]/30 transition-colors group cursor-pointer">
                <i class="fa-solid fa-industry text-2xl text-[#10B981] mb-2 group-hover:scale-110 transition-transform"></i>
                <span class="text-sm font-medium text-white">Add Industry</span>
            </a>

            <a href="{{ route('admin.gallery.create') }}" class="flex flex-col items-center p-4 rounded-lg bg-[#183B56]/20 hover:bg-[#183B56]/30 transition-colors group cursor-pointer">
                <i class="fa-solid fa-image text-2xl text-[#EC4899] mb-2 group-hover:scale-110 transition-transform"></i>
                <span class="text-sm font-medium text-white">Upload Gallery</span>
            </a>
        </div>
    </div>

    <!-- Recent Inquiries -->
    <div class="admin-card rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-white">Recent Inquiries</h3>
            <a href="{{ route('admin.inquiries.index') }}" class="text-sm text-[#D6A84B] hover:text-[#E8BC56] font-medium">View All</a>
        </div>
        <div class="space-y-3">
            @foreach($recentInquiries as $inquiry)
                <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-[#183B56]/20 transition-colors cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-[#183B56]/30 flex items-center justify-center">
                        <i class="fa-solid fa-user text-[#9CA3AF] text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-medium text-white truncate">{{ $inquiry->name }}</div>
                        <div class="text-xs text-[#9CA3AF] truncate">{{ $inquiry->email }}</div>
                    </div>
                    <div>
                        <div class="status-badge status-badge-{{ $inquiry->status }}">
                            {{ $inquiry->status_label }}
                        </div>
                    </div>
                    <div class="text-xs text-[#9CA3AF]">{{ $inquiry->created_at->diffForHumans() }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
