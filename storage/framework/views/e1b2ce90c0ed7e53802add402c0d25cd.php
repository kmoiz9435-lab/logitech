<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-white">Admin Profile</h2>
        <p class="text-[#9CA3AF] mt-1">Apni profile aur password manage karein</p>
    </div>

    <?php if(session('success')): ?>
        <div class="admin-card rounded-xl p-4 text-sm text-[#6EE7B7] border-[#10B981]/40"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('admin.profile.update')); ?>" class="admin-card rounded-xl p-6 space-y-5">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <h3 class="text-lg font-bold text-white"><i class="fa-solid fa-user text-[#D6A84B] mr-2"></i>Profile Information</h3>
        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Name <span class="text-red-400">*</span></label>
                <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required class="form-input rounded-lg px-4 py-3 w-full">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Email <span class="text-red-400">*</span></label>
                <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required class="form-input rounded-lg px-4 py-3 w-full">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Phone</label>
                <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>" class="form-input rounded-lg px-4 py-3 w-full">
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="btn-primary px-6 py-3 rounded-lg font-semibold inline-flex items-center gap-2"><i class="fa-solid fa-floppy-disk"></i> Save Profile</button>
        </div>
    </form>

    <form method="POST" action="<?php echo e(route('admin.profile.password')); ?>" class="admin-card rounded-xl p-6 space-y-5">
        <?php echo csrf_field(); ?>
        <h3 class="text-lg font-bold text-white"><i class="fa-solid fa-lock text-[#D6A84B] mr-2"></i>Change Password</h3>
        <div class="grid md:grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">Current Password</label>
                <input type="password" name="current_password" required class="form-input rounded-lg px-4 py-3 w-full">
                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#9CA3AF] mb-2">New Password</label>
                <input type="password" name="password" required class="form-input rounded-lg px-4 py-3 w-full">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\website 2\resources\views\admin\profile\edit.blade.php ENDPATH**/ ?>