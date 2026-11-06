<?php $__env->startSection('content'); ?>

    
    <section id="home" class="relative min-h-[72vh] flex items-center overflow-hidden">
        <img src="<?php echo e(\media_url(\section_value('hero', 'image'), 'uploads/seed/hero-induction.jpg')); ?>" alt="Industrial induction heating machinery" class="absolute inset-0 w-full h-full object-cover z-0 opacity-50 scale-105" loading="eager">
        <div class="absolute inset-0 bg-gradient-to-r from-[#101D2D]/95 via-[#101D2D]/80 to-[#183B56]/70 z-10"></div>
        <div class="absolute -top-32 right-0 w-[34rem] h-[34rem] rounded-full bg-[#D6A84B]/10 blur-[130px] z-10 pointer-events-none"></div>
        <div class="relative z-20 container mx-auto px-6 lg:px-16 pt-28 lg:pt-32 pb-8 lg:pb-16">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-4">
                    <span class="h-px w-10 accent-line"></span>
                    <span class="text-[#D6A84B] font-bold text-[11px] md:text-xs uppercase tracking-[0.22em]">
                        <?php echo e(\section_value('hero', 'eyebrow', 'Precision Induction Technology')); ?>

                    </span>
                </div>
                <h1 class="text-gradient-gold text-4xl md:text-5xl lg:text-[4.4rem] font-extrabold leading-[1.03] tracking-[-0.03em] mb-5">
                    <?php echo e(\section_value('hero', 'heading', 'Advanced Induction Heating Solutions')); ?>

                </h1>
                <h2 class="text-sm md:text-base text-[#E8BC56] font-bold uppercase tracking-[0.2em] mb-5 leading-[1.8]">
                    <?php echo e(\section_value('hero', 'sub_heading', 'Precision Engineering. Efficient Heating. Industrial Performance.')); ?>

                </h2>
                <p class="text-sm md:text-base text-[#F4F6F8]/65 mb-7 max-w-xl leading-[1.85] border-l-2 border-[#D6A84B]/40 pl-4">
                    <?php echo e(\section_value('hero', 'content', 'We provide advanced induction heating machinery designed for precision, efficiency, reliability, and demanding industrial applications.')); ?>

                </p>
                <div class="flex flex-col sm:flex-row flex-wrap gap-3 items-center sm:items-start">
                    <a href="#products" class="group inline-flex items-center justify-center gap-2 w-full max-w-[240px] sm:w-auto px-6 py-3 bg-gradient-to-r from-[#D6A84B] to-[#E8BC56] text-[#101D2D] rounded-full font-bold text-sm hover:from-[#E8BC56] hover:to-[#F2D48A] hover:-translate-y-0.5 transition-all shadow-[0_8px_30px_rgba(214,168,75,0.3)]">
                        <?php echo e(\setting('hero_primary_btn', 'Explore Our Products')); ?> <i class="fa-solid fa-arrow-right-long text-sm transition-transform group-hover:translate-x-1"></i>
                    </a>
                    <a href="#contact" class="group inline-flex items-center justify-center gap-2 w-full max-w-[240px] sm:w-auto px-6 py-3 border border-white/25 text-white rounded-full font-semibold text-sm hover:bg-white/10 hover:border-white/40 hover:-translate-y-0.5 transition-all backdrop-blur-sm">
                        <?php echo e(\setting('hero_secondary_btn', 'Request a Quote')); ?> <i class="fa-regular fa-paper-plane text-sm transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-[#101D2D] to-transparent z-20"></div>
    </section>

    
    <section id="about" class="relative bg-[#101D2D] pt-8 pb-12 lg:py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-10 items-center">
                <div>
                    <span class="inline-flex items-center gap-2 text-[#D6A84B] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span><?php echo e(\section_value('about', 'eyebrow', 'About InduHeat')); ?></span>
                    <h2 class="text-gradient-gold text-3xl md:text-[2.6rem] font-extrabold leading-[1.1] tracking-tight mb-4"><?php echo e(\section_value('about', 'heading', 'Engineering the Future of Industrial Heating')); ?></h2>
                    <p id="about-description" class="read-more-content is-collapsed text-[#F4F6F8]/70 text-base md:text-lg leading-[1.7] mb-2 whitespace-pre-line"><?php echo e(Str::of(\section_value('about', 'content'))->replace("\n", "\n\n")); ?></p>
                    <button type="button" class="read-more-toggle mb-3 inline-flex items-center gap-1.5 text-[#D6A84B] text-sm font-semibold hover:text-[#E8BC56] transition-colors lg:hidden" aria-expanded="false" aria-controls="about-description">
                        <span>Read More</span>
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </button>
                    <?php
                        $aboutPoints = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) \setting('about_points'))));
                    ?>
                    <?php if(count($aboutPoints)): ?>
                        <ul class="space-y-2.5 mb-4 mt-4">
                            <?php $__currentLoopData = $aboutPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="flex items-start gap-3 text-sm text-[#F4F6F8]/70">
                                    <i class="fa-solid fa-circle-check text-[#D6A84B] text-sm mt-0.5 shrink-0"></i>
                                    <span><?php echo e($point); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                    <a href="#contact" class="inline-flex items-center gap-2 text-[#D6A84B] font-semibold hover:text-[#E8BC56] transition-colors mt-2"><?php echo e(\setting('about_learn_more', 'Learn More')); ?> <i class="fa-solid fa-arrow-right-long text-xs"></i></a>
                </div>
                <div class="relative">
                    <img src="<?php echo e(\media_url(\section_value('about', 'image'), 'uploads/seed/about-machine.jpg')); ?>" alt="Induction heating machinery engineering" class="w-full rounded-2xl shadow-[0_25px_60px_rgba(16,29,45,0.9)]" loading="lazy">
                    <div class="absolute -bottom-5 -left-5 bg-[#183B56] rounded-xl px-6 py-5 shadow-2xl max-w-xs border border-[#183B56]/60">
                        <div class="text-3xl font-extrabold text-[#D6A84B] mb-1"><?php echo e(\setting('about_stat_value', '20+')); ?></div>
                        <div class="text-sm text-[#F4F6F8]/70"><?php echo e(\setting('about_stat_label', 'Years of Industrial Heating Expertise')); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section id="products" class="relative bg-[#0F1928] py-12 lg:py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="text-center max-w-3xl mx-auto mb-8">
                <span class="inline-flex items-center gap-2 text-[#D6A84B] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span><?php echo e(\section_value('products', 'eyebrow', 'Our Machinery')); ?></span>
                <h2 class="text-gradient-gold text-3xl md:text-[2.6rem] font-extrabold leading-[1.1] tracking-tight mb-5"><?php echo e(\section_value('products', 'heading', 'Induction Heating Machines Built for Performance')); ?></h2>
                <p class="text-[#F4F6F8]/60 text-base md:text-lg leading-relaxed"><?php echo e(\section_value('products', 'sub_heading', 'Explore our range of precision induction systems — engineered for repeatable results, low energy consumption and long service life.')); ?></p>
            </div>

            <div class="filter-chips grid grid-cols-2 gap-2 mb-6 sm:flex sm:flex-wrap sm:justify-center">
                <a href="<?php echo e(route('products.index')); ?>" class="flex items-center justify-center text-center px-3 sm:px-4 py-2 rounded-full text-xs sm:text-sm leading-tight font-semibold transition-colors <?php echo e($selectedCategory ? 'bg-[#183B56]/30 text-[#F4F6F8]/70 hover:text-white hover:bg-[#183B56]/60 border border-[#183B56]/30' : 'bg-[#D6A84B] text-[#101D2D] shadow-[0_4px_20px_rgba(214,168,75,0.25)]'); ?>"><?php echo e(\setting('products_all_label', 'All Products')); ?></a>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('products.index', ['category' => $cat->slug])); ?>" class="flex items-center justify-center text-center px-3 sm:px-4 py-2 rounded-full text-xs sm:text-sm leading-tight font-medium transition-colors <?php echo e($selectedCategory && $selectedCategory->id === $cat->id ? 'bg-[#D6A84B] text-[#101D2D] shadow-[0_4px_20px_rgba(214,168,75,0.25)]' : 'bg-[#183B56]/30 text-[#F4F6F8]/70 hover:text-white hover:bg-[#183B56]/60 border border-[#183B56]/30'); ?>"><?php echo e($cat->name); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <article class="group bg-[#101D2D] rounded-2xl overflow-hidden border border-[#183B56]/30 shadow-[0_8px_30px_rgba(16,29,45,0.6)] hover:shadow-[0_20px_60px_rgba(214,168,75,0.12)] transition-all duration-300 hover:-translate-y-1.5 flex flex-col">
                        <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="block overflow-hidden relative">
                            <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-60 object-cover group-hover:scale-[1.04] transition-transform duration-500" loading="lazy">
                            <?php if($product->is_featured): ?>
                                <span class="absolute top-3 left-3 bg-[#D6A84B] text-[#101D2D] text-[10px] font-extrabold uppercase tracking-wide px-2.5 py-1 rounded-md shadow-md"><?php echo e(\setting('products_featured_label', 'Featured')); ?></span>
                            <?php endif; ?>
                        </a>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-[#D6A84B]/90"><?php echo e($product->category?->name); ?></span>
                            </div>
                            <h3 class="text-xl font-extrabold mb-3 leading-tight tracking-tight">
                                <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="hover:text-[#D6A84B] transition-colors"><?php echo e($product->name); ?></a>
                            </h3>
                            <p class="text-[#F4F6F8]/60 text-sm leading-relaxed mb-5 flex-grow"><?php echo e($product->short_description); ?></p>
                            <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="inline-flex items-center gap-2 text-sm font-bold text-[#D6A84B] hover:text-[#F07832] transition-colors"><?php echo e(\setting('products_view_details_label', 'View Details')); ?> <i class="fa-solid fa-arrow-right-long text-xs"></i></a>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-3 text-center text-[#F4F6F8]/40 py-16"><?php echo e(\setting('products_empty_label', 'No products found for this category.')); ?></div>
                <?php endif; ?>
            </div>

            <div class="text-center mt-8">
                <a href="<?php echo e(route('products.index')); ?>" class="inline-flex items-center gap-2 px-7 py-3.5 border border-[#F4F6F8]/20 text-white rounded-full font-semibold hover:bg-white hover:text-[#101D2D] hover:border-white transition-all"><?php echo e(\setting('products_view_all_label', 'View All Products')); ?> <i class="fa-solid fa-arrow-right-long text-sm"></i></a>
            </div>
        </div>
    </section>

    
    <section id="industries" class="relative bg-[#101D2D] py-12 lg:py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="text-center max-w-3xl mx-auto mb-8">
                <span class="inline-flex items-center gap-2 text-[#D6A84B] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span><?php echo e(\section_value('industries', 'eyebrow', 'Industries We Serve')); ?></span>
                <h2 class="text-gradient-gold text-3xl md:text-[2.6rem] font-extrabold leading-[1.05] tracking-tight mb-5"><?php echo e(\section_value('industries', 'heading', 'Powering Critical Industrial Processes')); ?></h2>
                <p class="text-[#F4F6F8]/60 text-base md:text-lg leading-relaxed"><?php echo e(\section_value('industries', 'sub_heading', 'Our induction heating systems are trusted across metal-intensive industries where temperature control, speed and reliability directly affect the finished part.')); ?></p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
                <?php $__empty_1 = true; $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-[#0F1928] rounded-2xl border border-[#183B56]/30 p-7 hover:border-[#D6A84B]/30 transition-all hover:-translate-y-1 shadow-[0_8px_30px_rgba(16,29,45,0.4)] hover:shadow-[0_12px_40px_rgba(214,168,75,0.08)]">
                        <div class="w-14 h-14 rounded-xl bg-[#D6A84B]/10 flex items-center justify-center mb-5 text-[#D6A84B] text-xl">
                            <i class="fa-solid fa-<?php echo e($industry->icon ?? 'industry'); ?>"></i>
                        </div>
                        <h3 class="text-xl font-extrabold mb-3 tracking-tight"><?php echo e($industry->title); ?></h3>
                        <p class="text-[#F4F6F8]/60 text-sm leading-relaxed"><?php echo e($industry->description); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-4 text-center text-[#F4F6F8]/40 py-12"><?php echo e(\setting('industries_empty_label', 'Industries coming soon.')); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    
    <section id="why-choose" class="relative bg-[#0F1928] py-12 lg:py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="text-center max-w-3xl mx-auto mb-8">
                <span class="inline-flex items-center gap-2 text-[#D6A84B] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span><?php echo e(\section_value('why_choose', 'eyebrow', 'Why Choose Us')); ?></span>
                <h2 class="text-gradient-gold text-3xl md:text-[2.6rem] font-extrabold leading-[1.05] tracking-tight mb-5"><?php echo e(\section_value('why_choose', 'heading', 'Engineered Advantage, Proven in Production')); ?></h2>
                <p class="text-[#F4F6F8]/60 text-base md:text-lg leading-relaxed"><?php echo e(\section_value('why_choose', 'sub_heading', 'We combine advanced power electronics with practical engineering to deliver induction heating systems that keep your operation productive.')); ?></p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php $__empty_1 = true; $__currentLoopData = $whyChoose; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-[#101D2D] rounded-2xl border border-[#183B56]/20 p-8 hover:border-[#D6A84B]/20 transition-all hover:-translate-y-1 shadow-[0_8px_30px_rgba(16,29,45,0.4)] hover:shadow-[0_12px_40px_rgba(214,168,75,0.08)]">
                        <div class="w-14 h-14 rounded-xl bg-[#D6A84B]/10 flex items-center justify-center mb-5 text-[#F07832] text-xl">
                            <i class="fa-solid fa-<?php echo e($item->icon ?? 'check-circle'); ?>"></i>
                        </div>
                        <h3 class="text-xl font-extrabold mb-3 tracking-tight"><?php echo e($item->title); ?></h3>
                        <p class="text-[#F4F6F8]/60 text-sm leading-relaxed"><?php echo e($item->description); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-3 text-center text-[#F4F6F8]/40 py-12"><?php echo e(\setting('why_empty_label', 'Why Choose Us content coming soon.')); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    
    <section id="gallery" class="relative bg-[#101D2D] py-12 lg:py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="text-center max-w-3xl mx-auto mb-8">
                <span class="inline-flex items-center gap-2 text-[#D6A84B] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span><?php echo e(\section_value('gallery', 'eyebrow', 'Machinery Gallery')); ?></span>
                <h2 class="text-gradient-gold text-3xl md:text-[2.6rem] font-extrabold leading-[1.05] tracking-tight mb-5"><?php echo e(\section_value('gallery', 'heading', 'Inside Our Engineering & Production')); ?></h2>
                <p class="text-[#F4F6F8]/60 text-base md:text-lg leading-relaxed"><?php echo e(\section_value('gallery', 'sub_heading', 'A closer look at the machines, applications and precision work behind every InduHeat system.')); ?></p>
            </div>
            <div class="grid md:grid-cols-4 gap-4">
                <?php $__empty_1 = true; $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e($image->image_url); ?>" class="group relative overflow-hidden rounded-2xl aspect-[4/3] block shadow-[0_8px_30px_rgba(16,29,45,0.4)] hover:shadow-[0_15px_50px_rgba(214,168,75,0.15)] transition-shadow" data-lightbox="gallery">
                        <img src="<?php echo e($image->image_url); ?>" alt="<?php echo e($image->title ?? 'Industrial machinery'); ?>" class="w-full h-full object-cover group-hover:scale-[1.05] transition-transform duration-700" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#101D2D]/70 via-transparent to-transparent"></div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-4 text-center text-[#F4F6F8]/40 py-12"><?php echo e(\setting('gallery_empty_label', 'Gallery images coming soon.')); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    
    <section class="relative overflow-hidden">
        <img src="<?php echo e(\media_url(\section_value('cta', 'image'), 'uploads/seed/cta-welding.jpg')); ?>" alt="Industrial heating production" class="absolute inset-0 w-full h-full object-cover opacity-30" loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-r from-[#101D2D] via-[#101D2D]/90 to-[#183B56]/80"></div>
        <div class="relative container mx-auto px-6 lg:px-16 py-12 lg:py-16 text-center">
            <span class="inline-flex items-center gap-2 text-[#D6A84B] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span><?php echo e(\section_value('cta', 'eyebrow', 'Start a Conversation')); ?></span>
            <h2 class="text-gradient-gold text-3xl md:text-[2.8rem] font-extrabold leading-[1.1] mb-6 tracking-tight"><?php echo e(\section_value('cta', 'heading', 'Looking for the Right Induction Heating Solution?')); ?></h2>
            <p class="text-[#F4F6F8]/70 text-base md:text-lg mb-8 max-w-2xl mx-auto leading-relaxed"><?php echo e(\section_value('cta', 'content', 'Contact our team to discuss your industrial heating requirements. We will help you specify the right machine, coil and process parameters for your application.')); ?></p>
            <a href="#contact" class="inline-flex items-center gap-2 px-8 py-4 bg-[#D6A84B] text-[#101D2D] rounded-full font-extrabold hover:bg-[#E8BC56] transition-all shadow-[0_8px_30px_rgb(214,168,75,0.25)]"><?php echo e(\setting('cta_btn_label', 'Request a Quote')); ?> <i class="fa-solid fa-arrow-right-long"></i></a>
        </div>
    </section>

    
    <section id="contact" class="relative bg-[#101D2D] py-12 lg:py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="text-center max-w-3xl mx-auto mb-8">
                <span class="inline-flex items-center gap-2 text-[#D6A84B] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span><?php echo e(\section_value('contact', 'eyebrow', 'Contact Us')); ?></span>
                <h2 class="text-gradient-gold text-3xl md:text-[2.6rem] font-extrabold leading-[1.05] tracking-tight mb-5"><?php echo e(\section_value('contact', 'heading', "Let's Talk About Your Heating Application")); ?></h2>
                <p class="text-[#F4F6F8]/60 text-base md:text-lg leading-relaxed"><?php echo e(\section_value('contact', 'sub_heading', 'Share your process, material and production targets. Our engineers will respond with the right solution.')); ?></p>
            </div>
            <div class="grid lg:grid-cols-5 gap-6 lg:gap-8">
                <div class="lg:col-span-3 bg-[#0B1422] rounded-3xl border border-[#183B56]/25 p-8 md:p-10 shadow-[0_12px_40px_rgba(0,0,0,0.45)]">
                    <form method="POST" action="<?php echo e(route('inquiry.store')); ?>" id="quote-form">
                        <?php echo csrf_field(); ?>
                        <h3 class="text-xl font-extrabold text-[#E4EAF1] mb-6 tracking-tight pl-3 border-l-2 border-[#D6A84B]/60"><?php echo e(\setting('contact_form_heading', 'Send Us a Message')); ?></h3>
                        <input type="hidden" name="source" value="quote">
                        <input type="hidden" name="form_time" value="<?php echo e(time()); ?>">
                        <div class="grid md:grid-cols-2 gap-5 mb-5">
                            <input type="text" name="name" placeholder="<?php echo e(\setting('contact_name_label', 'Full Name')); ?>" required class="w-full px-5 py-3.5 rounded-xl bg-[#06101C] border border-[#183B56]/25 text-[#F4F6F8] placeholder-[#F4F6F8]/85 shadow-[inset_0_1px_3px_rgba(0,0,0,0.45)] focus:outline-none focus:border-[#D6A84B]/50 focus:ring-1 focus:ring-[#D6A84B]/25 transition-all text-sm" value="<?php echo e(old('name')); ?>">
                            <input type="text" name="company_name" placeholder="<?php echo e(\setting('contact_company_label', 'Company Name')); ?>" class="w-full px-5 py-3.5 rounded-xl bg-[#06101C] border border-[#183B56]/25 text-[#F4F6F8] placeholder-[#F4F6F8]/85 shadow-[inset_0_1px_3px_rgba(0,0,0,0.45)] focus:outline-none focus:border-[#D6A84B]/50 focus:ring-1 focus:ring-[#D6A84B]/25 transition-all text-sm" value="<?php echo e(old('company_name')); ?>">
                        </div>
                        <div class="grid md:grid-cols-2 gap-5 mb-5">
                            <input type="email" name="email" placeholder="<?php echo e(\setting('contact_email_label', 'Email Address')); ?>" required class="w-full px-5 py-3.5 rounded-xl bg-[#06101C] border border-[#183B56]/25 text-[#F4F6F8] placeholder-[#F4F6F8]/85 shadow-[inset_0_1px_3px_rgba(0,0,0,0.45)] focus:outline-none focus:border-[#D6A84B]/50 focus:ring-1 focus:ring-[#D6A84B]/25 transition-all text-sm" value="<?php echo e(old('email')); ?>">
                            <input type="tel" name="phone" placeholder="<?php echo e(\setting('contact_phone_label', 'Phone Number')); ?>" required class="w-full px-5 py-3.5 rounded-xl bg-[#06101C] border border-[#183B56]/25 text-[#F4F6F8] placeholder-[#F4F6F8]/85 shadow-[inset_0_1px_3px_rgba(0,0,0,0.45)] focus:outline-none focus:border-[#D6A84B]/50 focus:ring-1 focus:ring-[#D6A84B]/25 transition-all text-sm" value="<?php echo e(old('phone')); ?>">
                        </div>
                        <div class="mb-5">
                            <select name="product_id" class="w-full px-5 py-3.5 rounded-xl bg-[#06101C] border border-[#183B56]/25 text-[#F4F6F8] shadow-[inset_0_1px_3px_rgba(0,0,0,0.45)] focus:outline-none focus:border-[#D6A84B]/50 focus:ring-1 focus:ring-[#D6A84B]/25 transition-all text-sm appearance-none cursor-pointer" aria-label="<?php echo e(\setting('contact_product_label', 'Select Interested Product (optional)')); ?>">
                                <option value=""><?php echo e(\setting('contact_product_label', 'Select Interested Product (optional)')); ?></option>
                                <?php if(isset($inquiryProducts)): ?>
                                    <?php $__currentLoopData = $inquiryProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($product->id); ?>" <?php echo e(old('product_id') == $product->id ? 'selected' : ''); ?>><?php echo e($product->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <textarea name="message" rows="4" placeholder="<?php echo e(\setting('contact_message_label', 'Your message or requirements')); ?>" class="w-full px-5 py-3.5 rounded-xl bg-[#06101C] border border-[#183B56]/25 text-[#F4F6F8] placeholder-[#F4F6F8]/85 shadow-[inset_0_1px_3px_rgba(0,0,0,0.45)] focus:outline-none focus:border-[#D6A84B]/50 focus:ring-1 focus:ring-[#D6A84B]/25 transition-all text-sm resize-y mb-6" aria-label="<?php echo e(\setting('contact_message_label', 'Your message or requirements')); ?>"><?php echo e(old('message')); ?></textarea>
                        <button type="submit" class="w-full py-3.5 bg-[#D6A84B] text-[#101D2D] rounded-xl font-extrabold hover:bg-[#E8BC56] transition-all shadow-[0_8px_30px_rgb(214,168,75,0.25)]"><?php echo e(\setting('contact_submit_label', 'Send Message')); ?></button>
                        <input type="text" name="website" class="hidden" tabindex="-1" aria-hidden="true" autocomplete="off">
                        <?php if($errors->any()): ?>
                            <div class="mt-4 text-red-300 text-sm space-y-1"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div><?php echo e($err); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
                        <?php endif; ?>
                    </form>
                </div>
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-[#0B1422] rounded-2xl border border-[#183B56]/25 p-8 shadow-[0_12px_40px_rgba(0,0,0,0.45)]">
                        <h3 class="text-xl font-extrabold text-[#E4EAF1] mb-6 tracking-tight pl-3 border-l-2 border-[#D6A84B]/60"><?php echo e(\setting('contact_info_heading', 'Get In Touch')); ?></h3>
                        <ul class="space-y-5 text-sm">
                            <li class="flex items-start gap-4">
                                <span class="w-10 h-10 rounded-full bg-[#D6A84B]/10 flex items-center justify-center text-[#D6A84B] shrink-0"><i class="fa-solid fa-location-dot"></i></span>
                                <div>
                                    <div class="font-bold text-[#DCE3EB]"><?php echo e(\setting('contact_address_label', 'Address')); ?></div>
                                    <div class="text-[#F4F6F8]/60 leading-relaxed"><?php echo e(\setting('address', 'Plot 24, Industrial Estate, Lahore, Pakistan')); ?></div>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="w-10 h-10 rounded-full bg-[#D6A84B]/10 flex items-center justify-center text-[#D6A84B] shrink-0"><i class="fa-solid fa-phone"></i></span>
                                <div>
                                    <div class="font-bold text-[#DCE3EB]"><?php echo e(\setting('contact_phone_info_label', 'Phone')); ?></div>
                                    <a href="<?php echo e(\tel_link(\setting('phone'))); ?>" class="text-[#F4F6F8]/60 hover:text-[#D6A84B] transition-colors"><?php echo e(\setting('phone', '+92 300 123 4567')); ?></a><br>
                                    <a href="<?php echo e(\tel_link(\setting('phone_secondary'))); ?>" class="text-[#F4F6F8]/60 hover:text-[#D6A84B] transition-colors"><?php echo e(\setting('phone_secondary', '+92 42 3567 8900')); ?></a>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="w-10 h-10 rounded-full bg-[#D6A84B]/10 flex items-center justify-center text-[#D6A84B] shrink-0"><i class="fa-solid fa-envelope"></i></span>
                                <div>
                                    <div class="font-bold text-[#DCE3EB]"><?php echo e(\setting('contact_email_info_label', 'Email')); ?></div>
                                    <a href="<?php echo e(\mail_link(\setting('email'))); ?>" class="text-[#F4F6F8]/60 hover:text-[#D6A84B] transition-colors"><?php echo e(\setting('email', 'info@induheat.com')); ?></a><br>
                                    <a href="<?php echo e(\mail_link(\setting('email_secondary'))); ?>" class="text-[#F4F6F8]/60 hover:text-[#D6A84B] transition-colors"><?php echo e(\setting('email_secondary', 'sales@induheat.com')); ?></a>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="w-10 h-10 rounded-full bg-[#F07832]/10 flex items-center justify-center text-[#F07832] shrink-0"><i class="fa-brands fa-whatsapp"></i></span>
                                <div>
                                    <div class="font-bold text-[#DCE3EB]"><?php echo e(\setting('contact_whatsapp_info_label', 'WhatsApp')); ?></div>
                                    <a href="<?php echo e(\whatsapp_link(\setting('whatsapp_number'), 'Hello, I would like to inquire about induction heating machinery.')); ?>" target="_blank" class="text-[#F4F6F8]/60 hover:text-[#F07832] transition-colors"><?php echo e(\setting('whatsapp_number', '+92 300 123 4567')); ?></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-[#0B1422] rounded-2xl border border-[#183B56]/20 overflow-hidden shadow-[0_12px_40px_rgba(0,0,0,0.45)] h-56 lg:h-[280px]">
                        <iframe src="<?php echo e(\setting('map_embed_url', 'https://www.google.com/maps/place/Lahore+Industrial+Estate/@31.5204,74.3587,17z/data=!3m1!4b1!4m6!3m5!1s0x39190483e2b8e8f7:0x1e07fba5f2e5c8b4!8m2!3d31.5204!4d74.3587!16s%2Fg%2F11hn12l0j9?entry=ttu')); ?>" width="100%" height="100%" style="border:0; filter: grayscale(0.6) invert(0.92) contrast(1.05);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="<?php echo e(\setting('contact_map_title', 'Office location')); ?>"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if(session('success')): ?>
        <div id="success-toast" class="fixed bottom-6 right-6 z-50 bg-[#183B56] border border-[#D6A84B]/30 text-white px-6 py-4 rounded-2xl shadow-2xl animate-fade-up max-w-md text-sm leading-relaxed">
            <div class="flex items-start gap-3">
                <i class="fa-solid fa-check-circle text-[#D6A84B] mt-0.5"></i>
                <span><?php echo e(session('success')); ?></span>
            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\website 2\resources\views/home.blade.php ENDPATH**/ ?>