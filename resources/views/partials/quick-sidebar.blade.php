{{-- Floating Quick Contact Sidebar --}}
<aside id="floating-quick-sidebar" class="fixed right-0 top-1/2 -translate-y-1/2 z-50 flex flex-col items-end select-none transition-all duration-300" aria-label="Quick Contact Toolbar">
    {{-- Top 5 Action Buttons (Collapsible) --}}
    <div id="quick-sidebar-buttons" class="flex flex-col shadow-2xl rounded-tl-lg overflow-visible transition-all duration-300">
        {{-- 1. Skype --}}
        <a href="{{ setting('skype', 'skype:info@induheat.com?chat') }}" target="_blank" rel="noopener noreferrer"
           class="group relative w-11 h-11 sm:w-12 sm:h-12 bg-[#DDE3E8] text-[#477694] hover:bg-[#477694] hover:text-white flex items-center justify-center transition-all duration-200"
           aria-label="Contact on Skype">
            <i class="fa-brands fa-skype text-xl transition-transform group-hover:scale-110"></i>
            {{-- Tooltip --}}
            <span class="absolute right-full mr-3 px-3 py-1.5 bg-[#263746] text-white text-xs font-semibold rounded-md shadow-xl whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-50">
                Skype Us
            </span>
        </a>

        {{-- 2. Email --}}
        <a href="{{ mail_link(setting('email', 'info@induheat.com')) }}"
           class="group relative w-11 h-11 sm:w-12 sm:h-12 bg-[#477694] text-white hover:bg-[#366787] flex items-center justify-center transition-all duration-200"
           aria-label="Send Email">
            <i class="fa-solid fa-envelope text-lg transition-transform group-hover:scale-110"></i>
            {{-- Tooltip --}}
            <span class="absolute right-full mr-3 px-3 py-1.5 bg-[#263746] text-white text-xs font-semibold rounded-md shadow-xl whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-50">
                {{ setting('email', 'info@induheat.com') }}
            </span>
        </a>

        {{-- 3. Phone --}}
        <a href="{{ tel_link(setting('phone', '+92 300 123 4567')) }}"
           class="group relative w-11 h-11 sm:w-12 sm:h-12 bg-[#DDE3E8] text-[#477694] hover:bg-[#477694] hover:text-white flex items-center justify-center transition-all duration-200"
           aria-label="Call Business Number">
            <i class="fa-solid fa-phone text-lg transition-transform group-hover:scale-110"></i>
            {{-- Tooltip --}}
            <span class="absolute right-full mr-3 px-3 py-1.5 bg-[#263746] text-white text-xs font-semibold rounded-md shadow-xl whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-50">
                {{ setting('phone', '+92 300 123 4567') }}
            </span>
        </a>

        {{-- 4. Message / Inquiry Form --}}
        <a href="{{ route('home') }}#contact"
           class="group relative w-11 h-11 sm:w-12 sm:h-12 bg-[#477694] text-white hover:bg-[#366787] flex items-center justify-center transition-all duration-200"
           aria-label="Leave a Message">
            <i class="fa-solid fa-file-pen text-lg transition-transform group-hover:scale-110"></i>
            {{-- Tooltip --}}
            <span class="absolute right-full mr-3 px-3 py-1.5 bg-[#263746] text-white text-xs font-semibold rounded-md shadow-xl whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-50">
                Send Inquiry
            </span>
        </a>

        {{-- 5. Back to Top --}}
        <button type="button" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="group relative w-11 h-11 sm:w-12 sm:h-12 bg-[#DDE3E8] text-[#477694] hover:bg-[#477694] hover:text-white flex flex-col items-center justify-center transition-all duration-200 focus:outline-none"
                aria-label="Back to top of page">
            <span class="w-4 h-0.5 bg-current mb-0.5 rounded-full"></span>
            <i class="fa-solid fa-arrow-up text-sm transition-transform group-hover:-translate-y-0.5"></i>
            {{-- Tooltip --}}
            <span class="absolute right-full mr-3 px-3 py-1.5 bg-[#263746] text-white text-xs font-semibold rounded-md shadow-xl whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-50">
                Back to Top
            </span>
        </button>
    </div>

    {{-- 6. Expand / Collapse Arrow Button (Always Visible) --}}
    <button type="button" onclick="toggleQuickSidebar()"
            class="group relative w-11 h-11 sm:w-12 sm:h-12 bg-[#477694] text-white hover:bg-[#263746] flex items-center justify-center shadow-2xl rounded-bl-lg transition-colors focus:outline-none"
            aria-label="Toggle Quick Contact Sidebar">
        <i id="sidebar-toggle-icon" class="fa-solid fa-chevron-right text-base transition-transform duration-300"></i>
        {{-- Tooltip --}}
        <span id="sidebar-toggle-tip" class="absolute right-full mr-3 px-3 py-1.5 bg-[#263746] text-white text-xs font-semibold rounded-md shadow-xl whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-50">
            Collapse Sidebar
        </span>
    </button>
</aside>

<script>
    function toggleQuickSidebar() {
        const btnBox = document.getElementById('quick-sidebar-buttons');
        const icon = document.getElementById('sidebar-toggle-icon');
        const tip = document.getElementById('sidebar-toggle-tip');
        
        if (!btnBox || !icon) return;

        const isHidden = btnBox.classList.contains('translate-x-full');

        if (isHidden) {
            // Expand
            btnBox.classList.remove('translate-x-full', 'opacity-0', 'pointer-events-none');
            icon.className = 'fa-solid fa-chevron-right text-base transition-transform duration-300';
            if (tip) tip.textContent = 'Collapse Sidebar';
            localStorage.setItem('quick_sidebar_hidden', '0');
        } else {
            // Collapse
            btnBox.classList.add('translate-x-full', 'opacity-0', 'pointer-events-none');
            icon.className = 'fa-solid fa-chevron-left text-base transition-transform duration-300';
            if (tip) tip.textContent = 'Expand Sidebar';
            localStorage.setItem('quick_sidebar_hidden', '1');
        }
    }

    // Restore state from previous preference if saved
    document.addEventListener('DOMContentLoaded', () => {
        if (localStorage.getItem('quick_sidebar_hidden') === '1') {
            const btnBox = document.getElementById('quick-sidebar-buttons');
            const icon = document.getElementById('sidebar-toggle-icon');
            const tip = document.getElementById('sidebar-toggle-tip');
            if (btnBox && icon) {
                btnBox.classList.add('translate-x-full', 'opacity-0', 'pointer-events-none');
                icon.className = 'fa-solid fa-chevron-left text-base';
                if (tip) tip.textContent = 'Expand Sidebar';
            }
        }
    });
</script>
