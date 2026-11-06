<?php $__env->startSection('content'); ?>
<!-- Categories Index -->
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white">Product Categories</h2>
            <p class="text-[#9CA3AF] mt-1">Manage product categories and their display order</p>
        </div>
        <button onclick="document.getElementById('addCatModal').classList.remove('hidden')" class="btn-primary px-6 py-3 rounded-xl font-semibold text-sm inline-flex items-center gap-2 cursor-pointer">
            <i class="fa-solid fa-plus"></i>
            Add Category
        </button>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="admin-card rounded-xl p-6 hover:border-[#D6A84B]/30 transition-all group">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex gap-2">
                        <span class="badge <?php echo e($category->is_active ? 'badge-active' : 'badge-inactive'); ?>">
                            <?php echo e($category->is_active ? 'Active' : 'Inactive'); ?>

                        </span>
                    </div>
                </div>

                <h3 class="text-lg font-bold text-white mb-2"><?php echo e($category->name); ?></h3>
                <p class="text-[#9CA3AF] text-sm mb-4 line-clamp-2"><?php echo e($category->description ?: 'No description available'); ?></p>

                <div class="flex items-center justify-between">
                    <div class="text-xs text-[#9CA3AF]">
                        <span class="font-medium"><?php echo e($category->products_count ?? 0); ?></span> products
                    </div>
                    <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" class="p-2 text-[#9CA3AF] hover:text-[#3B82F6] transition-colors" title="Edit">
                            <i class="fa-solid fa-pencil text-sm"></i>
                        </a>
                        <button onclick="confirmDelete(<?php echo e($category->id); ?>)" class="p-2 text-[#9CA3AF] hover:text-red-400 transition-colors" title="Delete">
                            <i class="fa-solid fa-trash text-sm"></i>
                        </button>
                        <form id="delete-form-<?php echo e($category->id); ?>" action="<?php echo e(route('admin.categories.destroy', $category)); ?>" method="POST" class="hidden">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-12">
                <i class="fa-solid fa-folder-open text-5xl text-[#9CA3AF] mb-4"></i>
                <h3 class="text-xl font-medium text-white mb-2">No categories found</h3>
                <p class="text-[#9CA3AF] mb-6">Get started by creating your first product category</p>
                <button onclick="document.getElementById('addCatModal').classList.remove('hidden')" class="btn-primary px-6 py-3 rounded-lg font-medium inline-flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-plus"></i>
                    Add Category
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        <?php echo e($categories->links()); ?>

    </div>
</div>

<script>
    function confirmDelete(categoryId) {
        if (confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
            document.getElementById(`delete-form-${categoryId}`).submit();
        }
    }
</script>

<!-- Add Category Modal -->
<div id="addCatModal" class="hidden fixed inset-0 z-50 bg-black/70 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-[#101D2D] border border-[#1B2845] rounded-2xl w-full max-w-2xl p-6 shadow-2xl relative">
        <button onclick="document.getElementById('addCatModal').classList.add('hidden')" class="absolute top-4 right-4 text-[#9CA3AF] hover:text-white"><i class="fa-solid fa-xmark text-xl"></i></button>
        <h2 class="text-xl font-bold mb-4">Add New Category</h2>
        <form method="POST" action="<?php echo e(url('admin/categories')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>
            <input type="text" name="name" placeholder="Category Name" class="w-full px-4 py-3 rounded-lg bg-[#0F1928] border border-[#1B2845] text-white focus:outline-none focus:border-[#D6A84B]" required>
            <input type="text" name="slug" placeholder="Slug" class="w-full px-4 py-3 rounded-lg bg-[#0F1928] border border-[#1B2845] text-white focus:outline-none focus:border-[#D6A84B]" required>
            <textarea name="description" placeholder="Description" rows="3" class="w-full px-4 py-3 rounded-lg bg-[#0F1928] border border-[#1B2845] text-white focus:outline-none focus:border-[#D6A84B]"></textarea>
            <div class="flex items-center justify-between px-1">
                <label class="flex items-center gap-2 text-sm text-[#9CA3AF] cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" checked class="custom-checkbox">
                    Active (site pe dikhane ke liye ON)
                </label>
                <input type="number" name="sort_order" value="0" min="0" placeholder="Sort order" class="w-28 px-3 py-2 rounded-lg bg-[#0F1928] border border-[#1B2845] text-white text-sm focus:outline-none focus:border-[#D6A84B]">
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('addCatModal').classList.add('hidden')" class="flex-1 bg-[#183B56] text-white font-semibold py-3 rounded-lg hover:bg-[#25466B] transition">Close</button>
                <button type="submit" class="flex-1 bg-[#D6A84B] text-[#101D2D] font-bold py-3 rounded-lg hover:bg-[#b89230] transition">Save Category</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\website 2\resources\views\admin\categories\index.blade.php ENDPATH**/ ?>