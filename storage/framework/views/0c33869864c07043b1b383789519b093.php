
<?php $__env->startSection('content'); ?>
<!-- Category Create/Edit Form -->
<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-white"><?php echo e($category->exists ? 'Edit Category' : 'Add New Category'); ?></h2>
            <p class="text-[#9CA3AF] mt-1">
                <?php echo e($category->exists ? 'Update category information and display settings' : 'Create a new product category'); ?>

            </p>
        </div>
        <?php if($category->exists): ?>
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="px-4 py-2 text-[#9CA3AF] hover:text-white transition-colors">
                Cancel
            </a>
        <?php endif; ?>
    </div>

    <form id="admin-form" method="POST" action="<?php echo e($category->exists ? route('admin.categories.update', $category) : route('admin.categories.store')); ?>" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php if($category->exists): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <div class="admin-card rounded-xl p-6">
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Category Name <span class="text-red-400">*</span></label>
                    <input type="text" name="name" value="<?php echo e(old('name', $category->name)); ?>" required class="form-input rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-[#D6A84B]/20" placeholder="e.g., Induction Heating Machines">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Slug <span class="text-red-400">*</span></label>
                    <input type="text" name="slug" value="<?php echo e(old('slug', $category->slug)); ?>" required class="form-input rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-[#D6A84B]/20" placeholder="induction-heating-machines">
                    <p class="text-xs text-[#9CA3AF] mt-1">Auto slug from name</p>
                    <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Description</label>
                    <textarea name="description" rows="3" class="form-input rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-[#D6A84B]/20" placeholder="Brief description of this category"><?php echo e(old('description', $category->description)); ?></textarea>
                    <p class="text-xs text-[#9CA3AF] mt-1">Maximum 3000 characters</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Category Image (Optional)</label>
                    <div class="space-y-3">
                        <?php if($category->image): ?>
                            <div class="relative">
                                <img src="<?php echo e($category->image ? asset('uploads/'.$category->image) : asset('assets/images/placeholder.svg')); ?>" alt="Category image" class="w-32 rounded-lg mb-3">
                                <button type="button" onclick="document.getElementById('image_input').click()" class="text-sm text-[#D6A84B] hover:text-[#E8BC56]">
                                    Change Image
                                </button>
                            </div>
                        <?php endif; ?>
                        <input type="file" name="image" id="image_input" accept="image/*" class="hidden">
                        <button type="button" onclick="document.getElementById('image_input').click()" class="w-full border-2 border-dashed border-[#183B56]/40 rounded-lg p-6 hover:border-[#D6A84B]/60 transition-colors">
                            <i class="fa-solid fa-plus text-xl text-[#9CA3AF] mb-2 block"></i>
                            <span class="text-sm text-[#9CA3AF] block mb-1">Add Category Image</span>
                            <span class="text-xs text-[#9CA3AF]">JPG, PNG, WebP (max 6MB)</span>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Sort Order</label>
                        <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $category->sort_order)); ?>" min="0" class="form-input rounded-lg px-4 py-3 w-full focus:ring-2 focus:ring-[#D6A84B]/20">
                    </div>
                    <div class="flex items-center justify-center">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $category->is_active) ? 'checked' : ''); ?> class="custom-checkbox">
                            <span class="ml-3 text-sm font-medium text-[#F4F6F8]">Active Status</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end gap-4 pt-6">
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="px-6 py-3 text-[#9CA3AF] hover:text-white transition-colors font-medium">Cancel</a>
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg font-semibold inline-flex items-center gap-2">
                <i class="fa-solid fa-save"></i>
                <?php echo e($category->exists ? 'Update Category' : 'Create Category'); ?>

            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\website 2\resources\views\admin\categories\create.blade.php ENDPATH**/ ?>