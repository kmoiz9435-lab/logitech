@extends('layouts.frontend')

@section('content')

    {{-- Hero Section --}}
    <section id="home" class="relative min-h-[85vh] lg:min-h-[88vh] flex items-center overflow-hidden bg-white">
        {{-- Right background image with heating machine --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ \media_url(\section_value('hero', 'image'), 'uploads/seed/hero-induction.jpg') }}?v={{ time() }}" alt="Industrial induction heating machinery" class="w-full h-full object-cover object-right" loading="eager">
            {{-- Soft White Gradient + Frosted Glass Blur between image and text --}}
            <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/75 to-transparent/10 backdrop-blur-[2px] z-10 pointer-events-none"></div>
            <div class="absolute inset-y-0 left-0 w-full md:w-3/5 bg-gradient-to-r from-white/90 via-white/80 to-transparent backdrop-blur-[3px] z-10 pointer-events-none"></div>
        </div>

        <div class="relative z-20 container mx-auto px-6 lg:px-16 pt-24 lg:pt-28 pb-24 lg:pb-32">
            <div class="max-w-2xl lg:max-w-3xl">
                {{-- Eyebrow --}}
                <div class="flex items-center gap-3 mb-4">
                    <span class="h-0.5 w-8 bg-[#366787]"></span>
                    <span class="text-[#366787] font-bold text-xs uppercase tracking-[0.22em]">
                        {{ \section_value('hero', 'eyebrow', 'Precision Induction Technology') }}
                    </span>
                </div>

                {{-- Main Heading matching mockup --}}
                @php
                    $rawHeading = \section_value('hero', 'heading', 'Advanced Induction Heating Solutions');
                    $formattedHeading = Str::contains($rawHeading, 'Induction')
                        ? Str::replace('Induction', '<span class="text-[#366787]">Induction</span>', e($rawHeading))
                        : e($rawHeading);

                    $heroContent = \section_value('hero', 'content');
                    if (empty($heroContent) || str_starts_with(trim($heroContent), '{')) {
                        $heroContent = 'We provide advanced induction heating machinery designed for precision, efficiency, reliability, and demanding industrial applications.';
                    }
                @endphp
                <h1 class="text-[#101D2D] text-4xl sm:text-5xl lg:text-[4.2rem] font-extrabold leading-[1.08] tracking-[-0.03em] mb-5">
                    {!! $formattedHeading !!}
                </h1>

                {{-- Subheading in Steel Blue --}}
                <h2 class="text-xs sm:text-sm text-[#366787] font-bold uppercase tracking-[0.2em] mb-5 leading-[1.8]">
                    {{ \section_value('hero', 'sub_heading', 'Precision Engineering. Efficient Heating. Industrial Performance.') }}
                </h2>

                {{-- Description with left border --}}
                <p class="text-sm md:text-base text-[#334155] mb-8 max-w-xl leading-[1.85] border-l-2 border-[#366787] pl-4 font-medium">
                    {{ $heroContent }}
                </p>

                {{-- Capsule Buttons matching mockup --}}
                <div class="flex flex-row flex-wrap sm:flex-nowrap items-center gap-3">
                    <a href="#products" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-[#366787] hover:bg-[#28526e] text-white rounded-full font-bold text-sm shadow-md hover:-translate-y-0.5 transition-all">
                        {{ \setting('hero_primary_btn', 'Explore Our Products') }} <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                    <a href="#contact" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white border border-[#101D2D] text-[#101D2D] hover:bg-gray-50 rounded-full font-semibold text-sm shadow-sm hover:-translate-y-0.5 transition-all">
                        {{ \setting('hero_secondary_btn', 'Request a Quote') }} <i class="fa-regular fa-paper-plane text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom Swoosh Wave matching mockup --}}
        <div class="absolute bottom-0 left-0 right-0 z-20 pointer-events-none overflow-hidden leading-none">
            <svg class="w-full h-12 sm:h-20 lg:h-28" viewBox="0 0 1440 100" fill="none" preserveAspectRatio="none">
                <!-- Soft lighter curve layer -->
                <path d="M0,45 C360,95 820,15 1440,65 L1440,100 L0,100 Z" fill="#DCE6EE" opacity="0.65"></path>
                <!-- Main wave swoosh layer -->
                <path d="M0,60 C320,110 760,25 1440,78 L1440,100 L0,100 Z" fill="#366787"></path>
            </svg>
        </div>
    </section>

    {{-- About Us --}}
    <section id="about" class="relative bg-[#FFFFFF] pt-8 pb-12 lg:py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-10 items-center">
                <div>
                    <span class="inline-flex items-center gap-2 text-[#477694] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span>{{ \section_value('about', 'eyebrow', 'About InduHeat') }}</span>
                    <h2 class="text-[#263746] text-3xl md:text-[2.6rem] font-extrabold leading-[1.1] tracking-tight mb-4">{{ \section_value('about', 'heading', 'Engineering the Future of Industrial Heating') }}</h2>
                    <p id="about-description" class="read-more-content is-collapsed text-[#475569] text-base md:text-lg leading-[1.7] mb-2 whitespace-pre-line">{{ Str::of(\section_value('about', 'content'))->replace("\n", "\n\n") }}</p>
                    <button type="button" class="read-more-toggle mb-3 inline-flex items-center gap-1.5 text-[#477694] text-sm font-semibold hover:text-[#263746] transition-colors lg:hidden" aria-expanded="false" aria-controls="about-description">
                        <span>Read More</span>
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </button>
                    @php
                        $aboutPoints = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) \setting('about_points'))));
                    @endphp
                    @if(count($aboutPoints))
                        <ul class="space-y-2.5 mb-4 mt-4">
                            @foreach($aboutPoints as $point)
                                <li class="flex items-start gap-3 text-sm text-[#334155]">
                                    <i class="fa-solid fa-circle-check text-[#477694] text-sm mt-0.5 shrink-0"></i>
                                    <span>{{ $point }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <a href="#contact" class="inline-flex items-center gap-2 text-[#477694] font-semibold hover:text-[#263746] transition-colors mt-2">{{ \setting('about_learn_more', 'Learn More') }} <i class="fa-solid fa-arrow-right-long text-xs"></i></a>
                </div>
                <div class="relative">
                    <img src="{{ \media_url(\section_value('about', 'image'), 'uploads/seed/about-machine.jpg') }}" alt="Induction heating machinery engineering" class="w-full rounded-2xl shadow-xl border border-[#AEB6BB]/30" loading="lazy">
                    <div class="absolute -bottom-5 -left-5 bg-[#263746] rounded-xl px-6 py-5 shadow-2xl max-w-xs border border-[#AEB6BB]/25">
                        <div class="text-3xl font-extrabold text-white mb-1">{{ \setting('about_stat_value', '20+') }}</div>
                        <div class="text-sm text-[#F5F5F5]/80">{{ \setting('about_stat_label', 'Years of Industrial Heating Expertise') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Products Section --}}
    <section id="products" class="relative bg-[#F5F5F5] py-12 lg:py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="text-center max-w-3xl mx-auto mb-8">
                <span class="inline-flex items-center gap-2 text-[#477694] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span>{{ \section_value('products', 'eyebrow', 'Our Machinery') }}</span>
                <h2 class="text-[#263746] text-3xl md:text-[2.6rem] font-extrabold leading-[1.1] tracking-tight mb-5">{{ \section_value('products', 'heading', 'Induction Heating Machines Built for Performance') }}</h2>
                <p class="text-[#64748B] text-base md:text-lg leading-relaxed">{{ \section_value('products', 'sub_heading', 'Explore our range of precision induction systems — engineered for repeatable results, low energy consumption and long service life.') }}</p>
            </div>

            <div class="filter-chips grid grid-cols-2 gap-2 mb-6 sm:flex sm:flex-wrap sm:justify-center">
                <a href="{{ route('products.index') }}" class="flex items-center justify-center text-center px-3 sm:px-4 py-2 rounded-full text-xs sm:text-sm leading-tight font-semibold transition-colors {{ $selectedCategory ? 'bg-white text-[#263746] hover:bg-[#477694] hover:text-white border border-[#AEB6BB]/50' : 'bg-[#477694] text-white shadow-md' }}">{{ \setting('products_all_label', 'All Products') }}</a>
                @foreach($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="flex items-center justify-center text-center px-3 sm:px-4 py-2 rounded-full text-xs sm:text-sm leading-tight font-medium transition-colors {{ $selectedCategory && $selectedCategory->id === $cat->id ? 'bg-[#477694] text-white shadow-md' : 'bg-white text-[#263746] hover:bg-[#477694] hover:text-white border border-[#AEB6BB]/50' }}">{{ $cat->name }}</a>
                @endforeach
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($products as $product)
                    <article class="group bg-[#FFFFFF] rounded-2xl overflow-hidden border border-[#AEB6BB]/40 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col">
                        <a href="{{ route('products.show', $product->slug) }}" class="block overflow-hidden relative">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-60 object-cover group-hover:scale-[1.04] transition-transform duration-500" loading="lazy">
                            @if($product->is_featured)
                                <span class="absolute top-3 left-3 bg-[#477694] text-white text-[10px] font-extrabold uppercase tracking-wide px-2.5 py-1 rounded-md shadow-md">{{ \setting('products_featured_label', 'Featured') }}</span>
                            @endif
                        </a>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-[#477694]">{{ $product->category?->name }}</span>
                            </div>
                            <h3 class="text-xl font-extrabold mb-3 leading-tight tracking-tight">
                                <a href="{{ route('products.show', $product->slug) }}" class="text-[#263746] hover:text-[#477694] transition-colors">{{ $product->name }}</a>
                            </h3>
                            <p class="text-[#64748B] text-sm leading-relaxed mb-5 flex-grow">{{ $product->short_description }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#477694] hover:text-[#263746] transition-colors">{{ \setting('products_view_details_label', 'View Details') }} <i class="fa-solid fa-arrow-right-long text-xs"></i></a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center text-[#64748B] py-16">{{ \setting('products_empty_label', 'No products found for this category.') }}</div>
                @endforelse
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-white border border-[#477694] text-[#477694] rounded-full font-semibold hover:bg-[#477694] hover:text-white transition-all shadow-sm">{{ \setting('products_view_all_label', 'View All Products') }} <i class="fa-solid fa-arrow-right-long text-sm"></i></a>
            </div>
        </div>
    </section>

    {{-- Industries Section --}}
    <section id="industries" class="relative bg-[#FFFFFF] py-12 lg:py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="text-center max-w-3xl mx-auto mb-8">
                <span class="inline-flex items-center gap-2 text-[#477694] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span>{{ \section_value('industries', 'eyebrow', 'Industries We Serve') }}</span>
                <h2 class="text-[#263746] text-3xl md:text-[2.6rem] font-extrabold leading-[1.05] tracking-tight mb-5">{{ \section_value('industries', 'heading', 'Powering Critical Industrial Processes') }}</h2>
                <p class="text-[#64748B] text-base md:text-lg leading-relaxed">{{ \section_value('industries', 'sub_heading', 'Our induction heating systems are trusted across metal-intensive industries where temperature control, speed and reliability directly affect the finished part.') }}</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
                @forelse($industries as $industry)
                    <div class="bg-[#F5F5F5] rounded-2xl border border-[#AEB6BB]/35 p-7 hover:border-[#477694] hover:bg-white transition-all hover:-translate-y-1 shadow-sm hover:shadow-md">
                        <div class="w-14 h-14 rounded-xl bg-[#477694]/10 flex items-center justify-center mb-5 text-[#477694] text-xl">
                            <i class="fa-solid fa-{{ $industry->icon ?? 'industry' }}"></i>
                        </div>
                        <h3 class="text-xl font-extrabold mb-3 tracking-tight text-[#263746]">{{ $industry->title }}</h3>
                        <p class="text-[#64748B] text-sm leading-relaxed">{{ $industry->description }}</p>
                    </div>
                @empty
                    <div class="col-span-4 text-center text-[#64748B] py-12">{{ \setting('industries_empty_label', 'Industries coming soon.') }}</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section id="why-choose" class="relative bg-[#F5F5F5] py-12 lg:py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="text-center max-w-3xl mx-auto mb-8">
                <span class="inline-flex items-center gap-2 text-[#477694] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span>{{ \section_value('why_choose', 'eyebrow', 'Why Choose Us') }}</span>
                <h2 class="text-[#263746] text-3xl md:text-[2.6rem] font-extrabold leading-[1.05] tracking-tight mb-5">{{ \section_value('why_choose', 'heading', 'Engineered Advantage, Proven in Production') }}</h2>
                <p class="text-[#64748B] text-base md:text-lg leading-relaxed">{{ \section_value('why_choose', 'sub_heading', 'We combine advanced power electronics with practical engineering to deliver induction heating systems that keep your operation productive.') }}</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($whyChoose as $item)
                    <div class="bg-[#FFFFFF] rounded-2xl border border-[#AEB6BB]/40 p-8 hover:border-[#477694] transition-all hover:-translate-y-1 shadow-sm hover:shadow-md">
                        <div class="w-14 h-14 rounded-xl bg-[#477694]/10 flex items-center justify-center mb-5 text-[#477694] text-xl">
                            <i class="fa-solid fa-{{ $item->icon ?? 'check-circle' }}"></i>
                        </div>
                        <h3 class="text-xl font-extrabold mb-3 tracking-tight text-[#263746]">{{ $item->title }}</h3>
                        <p class="text-[#64748B] text-sm leading-relaxed">{{ $item->description }}</p>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-[#64748B] py-12">{{ \setting('why_empty_label', 'Why Choose Us content coming soon.') }}</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Gallery --}}
    <section id="gallery" class="relative bg-[#FFFFFF] py-12 lg:py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="text-center max-w-3xl mx-auto mb-8">
                <span class="inline-flex items-center gap-2 text-[#477694] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span>{{ \section_value('gallery', 'eyebrow', 'Machinery Gallery') }}</span>
                <h2 class="text-[#263746] text-3xl md:text-[2.6rem] font-extrabold leading-[1.05] tracking-tight mb-5">{{ \section_value('gallery', 'heading', 'Inside Our Engineering & Production') }}</h2>
                <p class="text-[#64748B] text-base md:text-lg leading-relaxed">{{ \section_value('gallery', 'sub_heading', 'A closer look at the machines, applications and precision work behind every InduHeat system.') }}</p>
            </div>
            <div class="grid md:grid-cols-4 gap-4">
                @forelse($gallery as $image)
                    <a href="{{ $image->image_url }}" class="group relative overflow-hidden rounded-2xl aspect-[4/3] block shadow-sm hover:shadow-xl border border-[#AEB6BB]/40 transition-shadow" data-lightbox="gallery">
                        <img src="{{ $image->image_url }}" alt="{{ $image->title ?? 'Industrial machinery' }}" class="w-full h-full object-cover group-hover:scale-[1.05] transition-transform duration-700" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#263746]/70 via-transparent to-transparent"></div>
                    </a>
                @empty
                    <div class="col-span-4 text-center text-[#64748B] py-12">{{ \setting('gallery_empty_label', 'Gallery images coming soon.') }}</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="relative overflow-hidden">
        <img src="{{ \media_url(\section_value('cta', 'image'), 'uploads/seed/cta-welding.jpg') }}" alt="Industrial heating production" class="absolute inset-0 w-full h-full object-cover opacity-30" loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-r from-[#263746] via-[#263746]/95 to-[#477694]/90"></div>
        <div class="relative container mx-auto px-6 lg:px-16 py-12 lg:py-16 text-center">
            <span class="inline-flex items-center gap-2 text-[#AEB6BB] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span>{{ \section_value('cta', 'eyebrow', 'Start a Conversation') }}</span>
            <h2 class="text-white text-3xl md:text-[2.8rem] font-extrabold leading-[1.1] mb-6 tracking-tight">{{ \section_value('cta', 'heading', 'Looking for the Right Induction Heating Solution?') }}</h2>
            <p class="text-[#F5F5F5]/85 text-base md:text-lg mb-8 max-w-2xl mx-auto leading-relaxed">{{ \section_value('cta', 'content', 'Contact our team to discuss your industrial heating requirements. We will help you specify the right machine, coil and process parameters for your application.') }}</p>
            <a href="#contact" class="inline-flex items-center gap-2 px-8 py-4 bg-[#477694] text-white rounded-full font-extrabold hover:bg-[#38607a] transition-all shadow-[0_8px_30px_rgba(71,118,148,0.35)]">{{ \setting('cta_btn_label', 'Request a Quote') }} <i class="fa-solid fa-arrow-right-long"></i></a>
        </div>
    </section>

    {{-- Contact Section --}}
    <section id="contact" class="relative bg-[#F5F5F5] py-12 lg:py-16">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="text-center max-w-3xl mx-auto mb-8">
                <span class="inline-flex items-center gap-2 text-[#477694] text-[11px] font-bold uppercase tracking-[0.22em] mb-4"><span class="h-px w-6 accent-line"></span>{{ \section_value('contact', 'eyebrow', 'Contact Us') }}</span>
                <h2 class="text-[#263746] text-3xl md:text-[2.6rem] font-extrabold leading-[1.05] tracking-tight mb-5">{{ \section_value('contact', 'heading', "Let's Talk About Your Heating Application") }}</h2>
                <p class="text-[#64748B] text-base md:text-lg leading-relaxed">{{ \section_value('contact', 'sub_heading', 'Share your process, material and production targets. Our engineers will respond with the right solution.') }}</p>
            </div>
            <div class="grid lg:grid-cols-5 gap-6 lg:gap-8">
                <div class="lg:col-span-3 bg-[#FFFFFF] rounded-3xl border border-[#AEB6BB]/40 p-8 md:p-10 shadow-sm">
                    <form method="POST" action="{{ route('inquiry.store') }}" id="quote-form">
                        @csrf
                        <h3 class="text-xl font-extrabold text-[#263746] mb-6 tracking-tight pl-3 border-l-2 border-[#477694]">{{ \setting('contact_form_heading', 'Send Us a Message') }}</h3>
                        <input type="hidden" name="source" value="quote">
                        <input type="hidden" name="form_time" value="{{ time() }}">
                        <div class="grid md:grid-cols-2 gap-5 mb-5">
                            <input type="text" name="name" placeholder="{{ \setting('contact_name_label', 'Full Name') }}" required class="w-full px-5 py-3.5 rounded-xl bg-[#F5F5F5] border border-[#AEB6BB]/50 text-[#263746] placeholder-[#64748B] focus:outline-none focus:border-[#477694] focus:ring-1 focus:ring-[#477694]/25 transition-all text-sm" value="{{ old('name') }}">
                            <input type="text" name="company_name" placeholder="{{ \setting('contact_company_label', 'Company Name') }}" class="w-full px-5 py-3.5 rounded-xl bg-[#F5F5F5] border border-[#AEB6BB]/50 text-[#263746] placeholder-[#64748B] focus:outline-none focus:border-[#477694] focus:ring-1 focus:ring-[#477694]/25 transition-all text-sm" value="{{ old('company_name') }}">
                        </div>
                        <div class="grid md:grid-cols-2 gap-5 mb-5">
                            <input type="email" name="email" placeholder="{{ \setting('contact_email_label', 'Email Address') }}" required class="w-full px-5 py-3.5 rounded-xl bg-[#F5F5F5] border border-[#AEB6BB]/50 text-[#263746] placeholder-[#64748B] focus:outline-none focus:border-[#477694] focus:ring-1 focus:ring-[#477694]/25 transition-all text-sm" value="{{ old('email') }}">
                            <input type="tel" name="phone" placeholder="{{ \setting('contact_phone_label', 'Phone Number') }}" required class="w-full px-5 py-3.5 rounded-xl bg-[#F5F5F5] border border-[#AEB6BB]/50 text-[#263746] placeholder-[#64748B] focus:outline-none focus:border-[#477694] focus:ring-1 focus:ring-[#477694]/25 transition-all text-sm" value="{{ old('phone') }}">
                        </div>
                        <div class="mb-5">
                            <select name="product_id" class="w-full px-5 py-3.5 rounded-xl bg-[#F5F5F5] border border-[#AEB6BB]/50 text-[#263746] focus:outline-none focus:border-[#477694] focus:ring-1 focus:ring-[#477694]/25 transition-all text-sm appearance-none cursor-pointer" aria-label="{{ \setting('contact_product_label', 'Select Interested Product (optional)') }}">
                                <option value="">{{ \setting('contact_product_label', 'Select Interested Product (optional)') }}</option>
                                @if(isset($inquiryProducts))
                                    @foreach($inquiryProducts as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <textarea name="message" rows="4" placeholder="{{ \setting('contact_message_label', 'Your message or requirements') }}" class="w-full px-5 py-3.5 rounded-xl bg-[#F5F5F5] border border-[#AEB6BB]/50 text-[#263746] placeholder-[#64748B] focus:outline-none focus:border-[#477694] focus:ring-1 focus:ring-[#477694]/25 transition-all text-sm resize-y mb-6" aria-label="{{ \setting('contact_message_label', 'Your message or requirements') }}">{{ old('message') }}</textarea>
                        <button type="submit" class="w-full py-3.5 bg-[#477694] text-white rounded-xl font-extrabold hover:bg-[#38607a] transition-all shadow-md">{{ \setting('contact_submit_label', 'Send Message') }}</button>
                        <input type="text" name="website" class="hidden" tabindex="-1" aria-hidden="true" autocomplete="off">
                        @if($errors->any())
                            <div class="mt-4 text-red-500 text-sm space-y-1">@foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach</div>
                        @endif
                    </form>
                </div>
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-[#FFFFFF] rounded-2xl border border-[#AEB6BB]/40 p-8 shadow-sm">
                        <h3 class="text-xl font-extrabold text-[#263746] mb-6 tracking-tight pl-3 border-l-2 border-[#477694]">{{ \setting('contact_info_heading', 'Get In Touch') }}</h3>
                        <ul class="space-y-5 text-sm">
                            <li class="flex items-start gap-4">
                                <span class="w-10 h-10 rounded-full bg-[#477694]/10 flex items-center justify-center text-[#477694] shrink-0"><i class="fa-solid fa-location-dot"></i></span>
                                <div>
                                    <div class="font-bold text-[#263746]">{{ \setting('contact_address_label', 'Address') }}</div>
                                    <div class="text-[#64748B] leading-relaxed">{{ \setting('address', 'Plot 24, Industrial Estate, Lahore, Pakistan') }}</div>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="w-10 h-10 rounded-full bg-[#477694]/10 flex items-center justify-center text-[#477694] shrink-0"><i class="fa-solid fa-phone"></i></span>
                                <div>
                                    <div class="font-bold text-[#263746]">{{ \setting('contact_phone_info_label', 'Phone') }}</div>
                                    <a href="{{ \tel_link(\setting('phone')) }}" class="text-[#64748B] hover:text-[#477694] transition-colors">{{ \setting('phone', '+92 300 123 4567') }}</a><br>
                                    <a href="{{ \tel_link(\setting('phone_secondary')) }}" class="text-[#64748B] hover:text-[#477694] transition-colors">{{ \setting('phone_secondary', '+92 42 3567 8900') }}</a>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="w-10 h-10 rounded-full bg-[#477694]/10 flex items-center justify-center text-[#477694] shrink-0"><i class="fa-solid fa-envelope"></i></span>
                                <div>
                                    <div class="font-bold text-[#263746]">{{ \setting('contact_email_info_label', 'Email') }}</div>
                                    <a href="{{ \mail_link(\setting('email')) }}" class="text-[#64748B] hover:text-[#477694] transition-colors">{{ \setting('email', 'info@induheat.com') }}</a><br>
                                    <a href="{{ \mail_link(\setting('email_secondary')) }}" class="text-[#64748B] hover:text-[#477694] transition-colors">{{ \setting('email_secondary', 'sales@induheat.com') }}</a>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="w-10 h-10 rounded-full bg-[#477694]/10 flex items-center justify-center text-[#477694] shrink-0"><i class="fa-brands fa-whatsapp"></i></span>
                                <div>
                                    <div class="font-bold text-[#263746]">{{ \setting('contact_whatsapp_info_label', 'WhatsApp') }}</div>
                                    <a href="{{ \whatsapp_link(\setting('whatsapp_number'), 'Hello, I would like to inquire about induction heating machinery.') }}" target="_blank" class="text-[#64748B] hover:text-[#477694] transition-colors">{{ \setting('whatsapp_number', '+92 300 123 4567') }}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-[#FFFFFF] rounded-2xl border border-[#AEB6BB]/40 overflow-hidden shadow-sm h-56 lg:h-[280px]">
                        <iframe src="{{ \setting('map_embed_url', 'https://www.google.com/maps/place/Lahore+Industrial+Estate/@31.5204,74.3587,17z/data=!3m1!4b1!4m6!3m5!1s0x39190483e2b8e8f7:0x1e07fba5f2e5c8b4!8m2!3d31.5204!4d74.3587!16s%2Fg%2F11hn12l0j9?entry=ttu') }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="{{ \setting('contact_map_title', 'Office location') }}"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(session('success'))
        <div id="success-toast" class="fixed bottom-6 right-6 z-50 bg-[#263746] border border-[#477694] text-white px-6 py-4 rounded-2xl shadow-2xl animate-fade-up max-w-md text-sm leading-relaxed">
            <div class="flex items-start gap-3">
                <i class="fa-solid fa-check-circle text-[#477694] mt-0.5"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

@endsection
