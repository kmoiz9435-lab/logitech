@extends('admin.layouts.admin')
@section('content')
<!-- Products Index -->
<div class="space-y-6 overflow-x-auto">
    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white">Product Management</h2>
            <p class="text-[#9CA3AF] mt-1">Manage your induction heating products</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold text-sm inline-flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            Add Product
        </a>
    </div>

    <!-- Filters -->
    <div class="admin-card rounded-xl p-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Search</label>
                <input type="text" name="q" value="{{ $search }}" placeholder="Search products..." class="form-input rounded-lg px-4 py-2 w-full">
            </div>

            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Status</label>
                <select name="status" class="form-input rounded-lg px-4 py-2 w-full">
                    <option value="">All Status</option>
                    <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Featured</label>
                <select name="featured" class="form-input rounded-lg px-4 py-2 w-full">
                    <option value="">All</option>
                    <option value="yes" {{ $featured === 'yes' ? 'selected' : '' }}>Featured</option>
                    <option value="no" {{ $featured === 'no' ? 'selected' : '' }}>Not Featured</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Category</label>
                <select name="category" class="form-input rounded-lg px-4 py-2 w-full">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-4 flex gap-3">
                <button type="submit" class="btn-primary px-6 py-2 rounded-lg font-medium">Apply Filters</button>
                <a href="{{ route('admin.products.index') }}" class="btn-secondary px-6 py-2 rounded-lg font-medium">Clear</a>
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="admin-card rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#0F1928] border-b border-[#183B56]/30">
                    <tr>
                        <th class="px-6 py-4 text-left">
                            <input type="checkbox" class="custom-checkbox select-all-checkbox">
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-[#9CA3AF] uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-[#9CA3AF] uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-[#9CA3AF] uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-[#9CA3AF] uppercase tracking-wider">Featured</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-[#9CA3AF] uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-[#9CA3AF] uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#183B56]/20">
                    @foreach($products as $product)
                        <tr class="table-row-hover group">
                            <td class="px-6 py-4">
                                <input type="checkbox" class="custom-checkbox item-checkbox">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover mr-4">
                                    <div>
                                        <div class="font-medium text-white">{{ $product->name }}</div>
                                        <div class="text-xs text-[#9CA3AF]">{{ $product->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="badge badge-category">{{ $product->category?->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($product->is_featured)
                                    <span class="badge badge-featured">Featured</span>
                                @else
                                    <span class="text-xs text-[#9CA3AF]">No</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-[#F4F6F8]">{{ $product->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-[#9CA3AF]">{{ $product->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="p-2 text-[#9CA3AF] hover:text-[#D6A84B] transition-colors" title="View">
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-[#9CA3AF] hover:text-[#3B82F6] transition-colors" title="Edit">
                                        <i class="fa-solid fa-pencil text-sm"></i>
                                    </a>
                                    <button onclick="confirmDelete({{ $product->id }})" class="p-2 text-[#9CA3AF] hover:text-red-400 transition-colors" title="Delete">
                                        <i class="fa-solid fa-trash text-sm"></i>
                                    </button>
                                    <form id="delete-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($products->isEmpty())
            <div class="text-center py-12">
                <i class="fa-solid fa-box-open text-5xl text-[#9CA3AF] mb-4"></i>
                <h3 class="text-xl font-medium text-white mb-2">No products found</h3>
                <p class="text-[#9CA3AF] mb-6">Try adjusting your search or filters</p>
                <a href="{{ route('admin.products.create') }}" class="btn-primary px-6 py-3 rounded-lg font-medium inline-flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i>
                    Add Product
                </a>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->withQueryString()->links() }}
    </div>
</div>

<script>
    function confirmDelete(productId) {
        if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
            document.getElementById(`delete-form-${productId}`).submit();
        }
    }

    // Bulk actions
    document.querySelectorAll('.select-all-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const itemCheckbox = row.querySelector('.item-checkbox');
                if (itemCheckbox) {
                    itemCheckbox.checked = this.checked;
                }
            });
        });
    });
</script>
@endsection
