<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
    <form method="POST" action="<?php echo e(url('admin/login')); ?>" class="bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-md">
        <?php echo csrf_field(); ?>
        <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
        <?php if($errors->any()): ?>
            <div class="text-red-400 text-sm mb-4"><?php echo e($errors->first()); ?></div>
        <?php endif; ?>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" id="email" class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:border-blue-500" required autofocus>
        </div>
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium mb-1">Password</label>
            <div class="relative flex items-center">
                <input type="password" name="password" id="password" class="w-full px-3 py-2 pr-10 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:border-blue-500" required>
                <button type="button" id="togglePasswordBtn" onclick="togglePasswordVisibility()" class="absolute right-0 pr-3 flex items-center text-gray-400 hover:text-gray-200 focus:outline-none cursor-pointer" title="Show / Hide Password" aria-label="Toggle password visibility">
                    <!-- Eye Icon (Show) -->
                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <!-- Eye Slash Icon (Hide) -->
                    <svg id="eyeSlashIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
                    </svg>
                </button>
            </div>
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded font-semibold transition">Login</button>
    </form>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\website 2\resources\views\admin\auth\login.blade.php ENDPATH**/ ?>