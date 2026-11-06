<nav id="main-navbar" class="fixed top-0 left-0 right-0 z-50 bg-[#101D2D]/95 backdrop-blur-md border-b border-[#183B56]/20 transition-all duration-300">
    <div class="container mx-auto px-4 sm:px-6 lg:px-16">
        <div class="flex items-center justify-between h-20">
            <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                <img src="{{ media_url(setting('logo'), 'assets/images/logo.png') }}" alt="{{ setting('company_name', 'InduHeat Systems') }}" class="h-10 sm:h-12 w-auto max-w-[200px] sm:max-w-none object-contain">
            </a>

            <button id="mobile-menu-btn" class="lg:hidden p-2 text-white hover:text-[#D6A84B] transition-colors focus:outline-none" aria-label="Open menu">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>

            <div class="hidden lg:flex flex-1 justify-center items-center gap-1 bg-white/5 rounded-full px-2 py-1.5 border border-white/10 backdrop-blur-sm mx-6">
                <a href="{{ route('home') }}#about" class="nav-link px-3 py-1.5 rounded-full text-[#F4F6F8]/90 hover:text-white hover:bg-[#D6A84B]/20 transition font-medium text-sm">{{ setting('nav_about_label', 'About Us') }}</a>
                <a href="{{ route('home') }}#industries" class="nav-link px-3 py-1.5 rounded-full text-[#F4F6F8]/90 hover:text-white hover:bg-[#D6A84B]/20 transition font-medium text-sm">{{ setting('nav_industries_label', 'Industries') }}</a>
                <a href="{{ route('products.index') }}" class="nav-link px-3 py-1.5 rounded-full text-[#F4F6F8]/90 hover:text-white hover:bg-[#D6A84B]/20 transition font-medium text-sm">{{ setting('nav_products_label', 'Products') }}</a>
                <a href="{{ route('home') }}#why-choose" class="nav-link px-3 py-1.5 rounded-full text-[#F4F6F8]/90 hover:text-white hover:bg-[#D6A84B]/20 transition font-medium text-sm">{{ setting('nav_why_label', 'Why Choose Us') }}</a>
                <a href="{{ route('home') }}#contact" class="nav-link px-3 py-1.5 rounded-full text-[#F4F6F8]/90 hover:text-white hover:bg-[#D6A84B]/20 transition font-medium text-sm">{{ setting('nav_contact_label', 'Contact') }}</a>
                <a href="{{ route('home') }}#gallery" class="nav-link px-3 py-1.5 rounded-full text-[#F4F6F8]/90 hover:text-white hover:bg-[#D6A84B]/20 transition font-medium text-sm">{{ setting('nav_gallery_label', 'Gallery') }}</a>
            </div>

            @if(filled(setting('nav_cta_label')))
                <a href="{{ route('home') }}#contact" class="hidden lg:inline-flex shrink-0 items-center gap-2 px-5 py-2.5 rounded-full bg-[#D6A84B] text-[#101D2D] font-semibold text-sm hover:bg-[#e3b95f] transition-colors">
                    {{ setting('nav_cta_label') }}
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            @endif
        </div>
    </div>

    <div id="mobile-menu" class="lg:hidden hidden bg-[#101D2D] border-t border-[#183B56]/20 max-h-[calc(100vh-5rem)] overflow-y-auto">
        <div class="container mx-auto px-6 py-4 space-y-2">
            <a href="{{ route('home') }}" class="block py-3 px-4 text-[#F4F6F8]/80 hover:bg-[#183B56]/40 hover:text-white rounded-lg transition-colors">{{ setting('nav_home_label', 'Home') }}</a>
            <a href="{{ route('home') }}#about" class="block py-3 px-4 text-[#F4F6F8]/80 hover:bg-[#183B56]/40 hover:text-white rounded-lg transition-colors">{{ setting('nav_about_label', 'About Us') }}</a>
            <a href="{{ route('home') }}#industries" class="block py-3 px-4 text-[#F4F6F8]/80 hover:bg-[#183B56]/40 hover:text-white rounded-lg transition-colors">{{ setting('nav_industries_label', 'Industries') }}</a>
            <a href="{{ route('products.index') }}" class="block py-3 px-4 text-[#F4F6F8]/80 hover:bg-[#183B56]/40 hover:text-white rounded-lg transition-colors">{{ setting('nav_products_label', 'Products') }}</a>
            <a href="{{ route('home') }}#why-choose" class="block py-3 px-4 text-[#F4F6F8]/80 hover:bg-[#183B56]/40 hover:text-white rounded-lg transition-colors">{{ setting('nav_why_label', 'Why Choose Us') }}</a>
            <a href="{{ route('home') }}#contact" class="block py-3 px-4 text-[#F4F6F8]/80 hover:bg-[#183B56]/40 hover:text-white rounded-lg transition-colors">{{ setting('nav_contact_label', 'Contact') }}</a>
            <a href="{{ route('home') }}#gallery" class="block py-3 px-4 text-[#F4F6F8]/80 hover:bg-[#183B56]/40 hover:text-white rounded-lg transition-colors">{{ setting('nav_gallery_label', 'Gallery') }}</a>
            @if(filled(setting('nav_cta_label')))
                <a href="{{ route('home') }}#contact" class="block text-center py-3 px-4 bg-[#D6A84B] text-[#101D2D] font-semibold rounded-lg transition-colors">{{ setting('nav_cta_label') }}</a>
            @endif
        </div>
    </div>
</nav>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        const navbar = document.getElementById('main-navbar');
        if (window.scrollY > 20) {
            navbar.classList.add('shadow-lg', 'bg-[#101D2D]/98');
            navbar.classList.remove('shadow-none');
        } else {
            navbar.classList.remove('shadow-lg', 'bg-[#101D2D]/98');
            navbar.classList.add('shadow-none', 'bg-[#101D2D]/95');
        }
    });

    // Mobile menu toggle
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
        const icon = this.querySelector('i');
        if (menu.classList.contains('hidden')) {
            icon.className = 'fa-solid fa-bars text-2xl';
        } else {
            icon.className = 'fa-solid fa-xmark text-2xl';
        }
    });

    // Smooth scroll for in-page anchor links
    document.querySelectorAll('a[href*="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            const hashIndex = href.indexOf('#');
            if (hashIndex === -1) return;

            const hash = href.substring(hashIndex);
            if (hash.length < 2) return;

            const isSamePage = href.startsWith('#') || href.startsWith(window.location.origin + window.location.pathname);

            if (isSamePage) {
                const target = document.querySelector(hash);
                if (target) {
                    e.preventDefault();
                    const offset = 80;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
                    window.scrollTo({ top: targetPosition, behavior: 'smooth' });
                }
                const menu = document.getElementById('mobile-menu');
                if (menu) {
                    menu.classList.add('hidden');
                    const icon = document.getElementById('mobile-menu-btn').querySelector('i');
                    if (icon) icon.className = 'fa-solid fa-bars text-2xl';
                }
            }
        });
    });

    // Active navigation highlighting
    window.addEventListener('scroll', () => {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        let current = '';
        const scrollY = window.pageYOffset;
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            const sectionHeight = section.offsetHeight;
            if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                current = section.getAttribute('id');
            }
        });
        navLinks.forEach(link => {
            link.classList.remove('text-[#D6A84B]', 'font-semibold');
            const href = link.getAttribute('href') || '';
            if (current && href.endsWith('#' + current)) {
                link.classList.add('text-[#D6A84B]', 'font-semibold');
            }
        });
    });
</script>
