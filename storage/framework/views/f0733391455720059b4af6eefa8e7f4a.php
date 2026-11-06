<?php
    $socials = [
        'social_facebook' => ['icon' => 'fa-facebook-f', 'label' => 'Facebook'],
        'social_instagram' => ['icon' => 'fa-instagram', 'label' => 'Instagram'],
        'social_linkedin' => ['icon' => 'fa-linkedin-in', 'label' => 'LinkedIn'],
        'social_youtube' => ['icon' => 'fa-youtube', 'label' => 'YouTube'],
        'social_x' => ['icon' => 'fa-x-twitter', 'label' => 'X'],
    ];
    $activeSocials = array_filter($socials, fn ($item, $key) => filled(setting($key)), ARRAY_FILTER_USE_BOTH);
?>

<footer class="bg-[#0B1521] border-t border-[#183B56]/40 mt-0">
    <div class="container mx-auto px-6 lg:px-16 py-10">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
            
            <div>
                <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center mb-4">
                    <img src="<?php echo e(media_url(setting('logo'), 'assets/images/logo.png')); ?>" alt="<?php echo e(setting('company_name', 'InduHeat Systems')); ?>" class="h-12 w-auto">
                </a>
                <h3 class="text-sm font-bold uppercase tracking-[0.18em] text-[#D6A84B] mb-3"><?php echo e(setting('footer_about_heading', 'About Us')); ?></h3>
                <p class="text-sm leading-relaxed text-[#F4F6F8]/60">
                    <?php echo e(setting('footer_about', setting('company_short_description'))); ?>

                </p>
            </div>

            
            <div>
                <h3 class="text-sm font-bold uppercase tracking-[0.18em] text-[#D6A84B] mb-3"><?php echo e(setting('footer_quick_links_heading', 'Quick Links')); ?></h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="<?php echo e(route('home')); ?>" class="text-[#F4F6F8]/60 hover:text-[#D6A84B] transition-colors"><?php echo e(setting('nav_home_label', 'Home')); ?></a></li>
                    <li><a href="<?php echo e(route('home')); ?>#about" class="text-[#F4F6F8]/60 hover:text-[#D6A84B] transition-colors"><?php echo e(setting('nav_about_label', 'About Us')); ?></a></li>
                    <li><a href="<?php echo e(route('home')); ?>#industries" class="text-[#F4F6F8]/60 hover:text-[#D6A84B] transition-colors"><?php echo e(setting('nav_industries_label', 'Industries')); ?></a></li>
                    <li><a href="<?php echo e(route('home')); ?>#why-choose" class="text-[#F4F6F8]/60 hover:text-[#D6A84B] transition-colors"><?php echo e(setting('nav_why_label', 'Why Choose Us')); ?></a></li>
                    <li><a href="<?php echo e(route('home')); ?>#gallery" class="text-[#F4F6F8]/60 hover:text-[#D6A84B] transition-colors"><?php echo e(setting('nav_gallery_label', 'Gallery')); ?></a></li>
                    <li><a href="<?php echo e(route('home')); ?>#contact" class="text-[#F4F6F8]/60 hover:text-[#D6A84B] transition-colors"><?php echo e(setting('nav_contact_label', 'Contact')); ?></a></li>
                </ul>
            </div>

            
            <div>
                <h3 class="text-sm font-bold uppercase tracking-[0.18em] text-[#D6A84B] mb-3"><?php echo e(setting('footer_products_heading', 'Products')); ?></h3>
                <ul class="space-y-2 text-sm">
                    <?php
                        $footerProducts = \App\Models\Product::query()->active()->ordered()->take(5)->get();
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $footerProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $footerProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li>
                            <a href="<?php echo e(route('products.show', $footerProduct->slug)); ?>" class="text-[#F4F6F8]/60 hover:text-[#D6A84B] transition-colors">
                                <?php echo e($footerProduct->name); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li><a href="<?php echo e(route('products.index')); ?>" class="text-[#F4F6F8]/60 hover:text-[#D6A84B] transition-colors"><?php echo e(setting('products_view_all_label', 'View All Products')); ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo e(route('products.index')); ?>" class="text-[#D6A84B] hover:text-[#e3b95f] transition-colors font-medium"><?php echo e(setting('products_view_all_label', 'View All Products')); ?></a></li>
                </ul>
            </div>

            
            <div>
                <h3 class="text-sm font-bold uppercase tracking-[0.18em] text-[#D6A84B] mb-3"><?php echo e(setting('footer_contact_heading', 'Contact')); ?></h3>
                <ul class="space-y-2.5 text-sm text-[#F4F6F8]/60">
                    <?php if(filled(setting('address'))): ?>
                        <li class="flex gap-3">
                            <i class="fa-solid fa-location-dot text-[#D6A84B] mt-1"></i>
                            <span><?php echo e(setting('address')); ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if(filled(setting('phone'))): ?>
                        <li class="flex gap-3">
                            <i class="fa-solid fa-phone text-[#D6A84B] mt-1"></i>
                            <a href="<?php echo e(tel_link(setting('phone'))); ?>" class="hover:text-[#D6A84B] transition-colors"><?php echo e(setting('phone')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(filled(setting('email'))): ?>
                        <li class="flex gap-3">
                            <i class="fa-solid fa-envelope text-[#D6A84B] mt-1"></i>
                            <a href="<?php echo e(mail_link(setting('email'))); ?>" class="hover:text-[#D6A84B] transition-colors break-all"><?php echo e(setting('email')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(filled(setting('business_hours'))): ?>
                        <li class="flex gap-3">
                            <i class="fa-solid fa-clock text-[#D6A84B] mt-1"></i>
                            <span><?php echo e(setting('business_hours')); ?></span>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php if(count($activeSocials)): ?>
                    <h3 class="text-sm font-bold uppercase tracking-[0.18em] text-[#D6A84B] mt-4 mb-3"><?php echo e(setting('footer_social_heading', 'Follow Us')); ?></h3>
                    <div class="flex items-center gap-2">
                        <?php $__currentLoopData = $activeSocials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(setting($key)); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo e($social['label']); ?>"
                               class="w-9 h-9 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-[#F4F6F8]/70 hover:bg-[#D6A84B] hover:text-[#101D2D] hover:border-[#D6A84B] transition-colors">
                                <i class="fa-brands <?php echo e($social['icon']); ?> text-sm"></i>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="border-t border-[#183B56]/30">
        <div class="container mx-auto px-6 lg:px-16 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-[#F4F6F8]/40">
            <p><?php echo e(setting('footer_copyright', '© '.date('Y').' '.setting('company_name', 'InduHeat Systems').'. All rights reserved.')); ?></p>
            <a href="<?php echo e(route('home')); ?>" class="hover:text-[#D6A84B] transition-colors"><?php echo e(setting('nav_home_label', 'Home')); ?></a>
        </div>
    </div>
</footer>
<?php /**PATH C:\xampp\htdocs\website 2\resources\views/partials/footer.blade.php ENDPATH**/ ?>