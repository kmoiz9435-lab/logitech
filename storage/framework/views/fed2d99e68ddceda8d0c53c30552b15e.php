<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-white">Add Why Choose Us Item</h2>
            <p class="text-[#9CA3AF] mt-1">Website ke Why Choose Us section mein naya point</p>
        </div>
        <a href="<?php echo e(route('admin.why-choose.index')); ?>" class="px-4 py-2 text-[#9CA3AF] hover:text-white transition-colors">Cancel</a>
    </div>

    <?php if($errors->any()): ?>
        <div class="admin-card rounded-xl p-4 text-sm text-red-300 mb-6 space-y-1">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div><?php echo e($err); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('admin.why-choose.store')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        <div class="admin-card rounded-xl p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="<?php echo e(old('title')); ?>" required class="form-input rounded-lg px-4 py-3 w-full" placeholder="e.g., Precision Engineering">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Description <span class="text-red-400">*</span></label>
                <textarea name="description" rows="3" required class="form-input rounded-lg px-4 py-3 w-full"><?php echo e(old('description')); ?></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Icon (Font Awesome) <span class="text-red-400">*</span></label>
                    <input type="text" name="icon" value="<?php echo e(old('icon', 'check-circle')); ?>" required class="form-input rounded-lg px-4 py-3 w-full">
                    <p class="text-xs text-[#9CA3AF] mt-1">Puri list: fontawesome.com/icons</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="<?php echo e(old('sort_order', 0)); ?>" min="0" class="form-input rounded-lg px-4 py-3 w-full">
                </div>
            </div>
            <label class="flex items-center gap-3 text-sm text-[#F4F6F8] cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" checked class="custom-checkbox"> Active (site pe dikhane ke liye)
            </label>
        </div>

        <div class="flex justify-end gap-4">
            <a href="<?php echo e(route('admin.why-choose.index')); ?>" class="px-6 py-3 text-[#9CA3AF] hover:text-white transition-colors font-medium">Cancel</a>
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg font-semibold inline-flex items-center gap-2"><i class="fa-solid fa-floppy-disk"></i> Save Item</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\website 2\resources\views\admin\why-choose\create.blade.php ENDPATH**/ ?>