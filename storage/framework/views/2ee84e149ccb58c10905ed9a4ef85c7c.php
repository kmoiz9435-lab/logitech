<?php $__env->startSection('content'); ?>
<?php
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
?>
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

    <?php if(session('success')): ?>
        <div class="admin-card rounded-xl p-4 text-sm text-[#6EE7B7] border-[#10B981]/40"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="admin-card rounded-xl p-4 text-sm text-red-300 space-y-1">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div><?php echo e($err); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <div class="flex flex-wrap gap-2">
        <?php $__currentLoopData = $titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="#section-<?php echo e($key); ?>" class="px-4 py-2 rounded-lg text-xs font-semibold bg-[#183B56]/40 text-[#F4F6F8]/80 hover:text-white hover:bg-[#183B56]/70 border border-[#183B56]/40 transition-colors"><?php echo e($title); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <form id="content-form" method="POST" action="<?php echo e(route('admin.content.update')); ?>" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div id="section-<?php echo e($key); ?>" class="admin-card rounded-xl p-6">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-lg font-bold text-white"><i class="fa-solid fa-layer-group text-[#D6A84B] mr-2"></i><?php echo e($titles[$key] ?? ucfirst($key)); ?></h3>
                    <span class="text-xs text-[#9CA3AF] uppercase tracking-wider"><?php echo e($key); ?></span>
                </div>
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Eyebrow / Small Label</label>
                        <input type="text" name="sections[<?php echo e($key); ?>][eyebrow]" value="<?php echo e(old("sections.$key.eyebrow", $section->eyebrow)); ?>" class="form-input rounded-lg px-4 py-3 w-full">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Heading</label>
                        <input type="text" name="sections[<?php echo e($key); ?>][heading]" value="<?php echo e(old("sections.$key.heading", $section->heading)); ?>" class="form-input rounded-lg px-4 py-3 w-full">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Sub Heading</label>
                        <input type="text" name="sections[<?php echo e($key); ?>][sub_heading]" value="<?php echo e(old("sections.$key.sub_heading", $section->sub_heading)); ?>" class="form-input rounded-lg px-4 py-3 w-full">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Content / Description</label>
                        <textarea name="sections[<?php echo e($key); ?>][content]" rows="4" class="form-input rounded-lg px-4 py-3 w-full"><?php echo e(old("sections.$key.content", $section->content)); ?></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Image</label>
                        <div class="flex items-center gap-5 flex-wrap">
                            <?php if($section->image): ?>
                                <img src="<?php echo e(media_url($section->image)); ?>" alt="<?php echo e($titles[$key] ?? $key); ?>" class="h-20 w-32 object-cover rounded-lg border border-[#183B56]/40">
                            <?php endif; ?>
                            <input type="file" name="sections[<?php echo e($key); ?>][image]" accept="image/*" class="form-input rounded-lg px-4 py-2.5 text-sm flex-1 min-w-[220px]">
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="flex justify-end gap-4 pb-6">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="px-6 py-3 text-[#9CA3AF] hover:text-white transition-colors font-medium">Cancel</a>
            <button type="submit" class="btn-primary px-8 py-3 rounded-lg font-semibold inline-flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Save Content
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\website 2\resources\views\admin\content\edit.blade.php ENDPATH**/ ?>