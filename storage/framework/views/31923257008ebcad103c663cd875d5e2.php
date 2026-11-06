<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white">Why Choose Us</h2>
            <p class="text-[#9CA3AF] mt-1">Home page ke "Why Choose Us" section ke points yahan se manage karein</p>
        </div>
        <a href="<?php echo e(route('admin.why-choose.create')); ?>" class="btn-primary px-6 py-3 rounded-xl font-semibold text-sm inline-flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Add Item
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="admin-card rounded-xl p-4 text-sm text-[#6EE7B7] border-[#10B981]/40"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="admin-card rounded-xl p-6 flex flex-col">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg bg-[#183B56]/30 flex items-center justify-center text-[#D6A84B] text-lg">
                        <i class="fa-solid fa-<?php echo e($item->icon ?: 'check-circle'); ?>"></i>
                    </div>
                    <span class="badge <?php echo e($item->is_active ? 'badge-active' : 'badge-inactive'); ?>"><?php echo e($item->is_active ? 'Active' : 'Inactive'); ?></span>
                </div>
                <h3 class="text-lg font-bold text-white mb-2"><?php echo e($item->title); ?></h3>
                <p class="text-[#9CA3AF] text-sm mb-4 line-clamp-3 flex-grow"><?php echo e($item->description); ?></p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-[#9CA3AF]">Sort: <?php echo e($item->sort_order); ?></span>
                    <div class="flex gap-2">
                        <a href="<?php echo e(route('admin.why-choose.edit', $item)); ?>" class="p-2 text-[#9CA3AF] hover:text-[#3B82F6] transition-colors" title="Edit"><i class="fa-solid fa-pencil text-sm"></i></a>
                        <button onclick="confirmDelete(<?php echo e($item->id); ?>)" class="p-2 text-[#9CA3AF] hover:text-red-400 transition-colors" title="Delete"><i class="fa-solid fa-trash text-sm"></i></button>
                        <form id="delete-form-<?php echo e($item->id); ?>" action="<?php echo e(route('admin.why-choose.destroy', $item)); ?>" method="POST" class="hidden">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-12">
                <i class="fa-solid fa-circle-check text-5xl text-[#9CA3AF] mb-4"></i>
                <h3 class="text-xl font-medium text-white mb-2">No items found</h3>
                <p class="text-[#9CA3AF] mb-6">Add points to show them on the website</p>
                <a href="<?php echo e(route('admin.why-choose.create')); ?>" class="btn-primary px-6 py-3 rounded-lg font-medium inline-flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Add Item
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-6"><?php echo e($items->links()); ?></div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Delete this item? This action cannot be undone.')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\website 2\resources\views\admin\why-choose\index.blade.php ENDPATH**/ ?>