@php
    $socials = [
        'social_facebook' => ['icon' => 'fa-facebook-f', 'label' => 'Facebook'],
        'social_instagram' => ['icon' => 'fa-instagram', 'label' => 'Instagram'],
        'social_linkedin' => ['icon' => 'fa-linkedin-in', 'label' => 'LinkedIn'],
        'social_youtube' => ['icon' => 'fa-youtube', 'label' => 'YouTube'],
        'social_x' => ['icon' => 'fa-x-twitter', 'label' => 'X'],
    ];
    $activeSocials = array_filter($socials, fn ($item, $key) => filled(setting($key)), ARRAY_FILTER_USE_BOTH);
@endphp

<footer class="bg-[#263746] border-t border-[#AEB6BB]/20 mt-0">
    <div class="container mx-auto px-6 lg:px-16 py-10">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
            {{-- Brand / About --}}
            <div>
                <a href="{{ route('home') }}" class="inline-flex items-center mb-4">
                    <img src="{{ media_url(setting('logo_white', setting('logo')), 'assets/images/logo-white.png') }}" alt="{{ setting('company_name', 'InduHeat Systems') }}" class="h-12 w-auto">
                </a>
                <h3 class="text-sm font-bold uppercase tracking-[0.18em] text-white mb-3">{{ setting('footer_about_heading', 'About Us') }}</h3>
                <p class="text-sm leading-relaxed text-[#F5F5F5]/70">
                    {{ setting('footer_about', setting('company_short_description')) }}
                </p>
            </div>

            {{-- Quick links --}}
            <div>
                <h3 class="text-sm font-bold uppercase tracking-[0.18em] text-white mb-3">{{ setting('footer_quick_links_heading', 'Quick Links') }}</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-[#F5F5F5]/70 hover:text-white transition-colors">{{ setting('nav_home_label', 'Home') }}</a></li>
                    <li><a href="{{ route('home') }}#about" class="text-[#F5F5F5]/70 hover:text-white transition-colors">{{ setting('nav_about_label', 'About Us') }}</a></li>
                    <li><a href="{{ route('home') }}#industries" class="text-[#F5F5F5]/70 hover:text-white transition-colors">{{ setting('nav_industries_label', 'Industries') }}</a></li>
                    <li><a href="{{ route('home') }}#why-choose" class="text-[#F5F5F5]/70 hover:text-white transition-colors">{{ setting('nav_why_label', 'Why Choose Us') }}</a></li>
                    <li><a href="{{ route('home') }}#gallery" class="text-[#F5F5F5]/70 hover:text-white transition-colors">{{ setting('nav_gallery_label', 'Gallery') }}</a></li>
                    <li><a href="{{ route('home') }}#contact" class="text-[#F5F5F5]/70 hover:text-white transition-colors">{{ setting('nav_contact_label', 'Contact') }}</a></li>
                </ul>
            </div>

            {{-- Products --}}
            <div>
                <h3 class="text-sm font-bold uppercase tracking-[0.18em] text-white mb-3">{{ setting('footer_products_heading', 'Products') }}</h3>
                <ul class="space-y-2 text-sm">
                    @php
                        $footerProducts = \App\Models\Product::query()->active()->ordered()->take(5)->get();
                    @endphp
                    @forelse($footerProducts as $footerProduct)
                        <li>
                            <a href="{{ route('products.show', $footerProduct->slug) }}" class="text-[#F5F5F5]/70 hover:text-white transition-colors">
                                {{ $footerProduct->name }}
                            </a>
                        </li>
                    @empty
                        <li><a href="{{ route('products.index') }}" class="text-[#F5F5F5]/70 hover:text-white transition-colors">{{ setting('products_view_all_label', 'View All Products') }}</a></li>
                    @endforelse
                    <li><a href="{{ route('products.index') }}" class="text-[#AEB6BB] hover:text-white transition-colors font-medium">{{ setting('products_view_all_label', 'View All Products') }}</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h3 class="text-sm font-bold uppercase tracking-[0.18em] text-white mb-3">{{ setting('footer_contact_heading', 'Contact') }}</h3>
                <ul class="space-y-2.5 text-sm text-[#F5F5F5]/70">
                    @if(filled(setting('address')))
                        <li class="flex gap-3">
                            <i class="fa-solid fa-location-dot text-[#AEB6BB] mt-1"></i>
                            <span>{{ setting('address') }}</span>
                        </li>
                    @endif
                    @if(filled(setting('phone')))
                        <li class="flex gap-3">
                            <i class="fa-solid fa-phone text-[#AEB6BB] mt-1"></i>
                            <a href="{{ tel_link(setting('phone')) }}" class="hover:text-white transition-colors">{{ setting('phone') }}</a>
                        </li>
                    @endif
                    @if(filled(setting('email')))
                        <li class="flex gap-3">
                            <i class="fa-solid fa-envelope text-[#AEB6BB] mt-1"></i>
                            <a href="{{ mail_link(setting('email')) }}" class="hover:text-white transition-colors break-all">{{ setting('email') }}</a>
                        </li>
                    @endif
                    @if(filled(setting('business_hours')))
                        <li class="flex gap-3">
                            <i class="fa-solid fa-clock text-[#AEB6BB] mt-1"></i>
                            <span>{{ setting('business_hours') }}</span>
                        </li>
                    @endif
                </ul>

                @if(count($activeSocials))
                    <h3 class="text-sm font-bold uppercase tracking-[0.18em] text-white mt-4 mb-3">{{ setting('footer_social_heading', 'Follow Us') }}</h3>
                    <div class="flex items-center gap-2">
                        @foreach($activeSocials as $key => $social)
                            <a href="{{ setting($key) }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $social['label'] }}"
                               class="w-9 h-9 rounded-full bg-white/10 border border-[#AEB6BB]/30 flex items-center justify-center text-[#F5F5F5] hover:bg-[#477694] hover:text-white hover:border-[#477694] transition-colors">
                                <i class="fa-brands {{ $social['icon'] }} text-sm"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="border-t border-[#AEB6BB]/15">
        <div class="container mx-auto px-6 lg:px-16 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-[#AEB6BB]/70">
            <p>{{ setting('footer_copyright', '© '.date('Y').' '.setting('company_name', 'InduHeat Systems').'. All rights reserved.') }}</p>
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ setting('nav_home_label', 'Home') }}</a>
        </div>
    </div>
</footer>
