const initLazyImages = () => {
    const images = document.querySelectorAll('img[loading="lazy"]');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    }, { rootMargin: '50px' });

    images.forEach(img => observer.observe(img));
};

const initLightbox = () => {
    const galleryLinks = document.querySelectorAll('[data-lightbox="gallery"]');
    if (galleryLinks.length === 0) return;

    galleryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const img = this.querySelector('img');
            const title = this.querySelector('div')?.textContent?.trim();
            openLightbox(img.src, title);
        });
    });
};

const openLightbox = (src, title = '') => {
    const overlay = document.createElement('div');
    overlay.className = 'fixed inset-0 z-50 bg-black/90 backdrop-blur-sm flex items-center justify-center p-4';
    overlay.id = 'lightbox-overlay';

    const content = document.createElement('div');
    content.className = 'relative max-w-6xl w-full';

    const img = document.createElement('img');
    img.src = src;
    img.alt = title || 'Gallery image';
    img.className = 'w-full max-h-[90vh] object-contain rounded-lg';

    const closeBtn = document.createElement('button');
    closeBtn.className = 'absolute top-4 right-4 w-12 h-12 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center text-white hover:bg-white/20 transition-colors';
    closeBtn.innerHTML = '<i class="fa-solid fa-xmark text-xl"></i>';
    closeBtn.onclick = () => document.getElementById('lightbox-overlay').remove();

    content.appendChild(img);
    content.appendChild(closeBtn);
    overlay.appendChild(content);
    document.body.appendChild(overlay);

    overlay.onclick = (e) => {
        if (e.target === overlay) overlay.remove();
    };

    document.addEventListener('keydown', function escapeHandler(e) {
        if (e.key === 'Escape') {
            overlay.remove();
            document.removeEventListener('keydown', escapeHandler);
        }
    });
};

const initFormValidation = () => {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500');
                    field.focus();
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            if (!isValid) {
                e.preventDefault();
                const errorMsg = document.createElement('div');
                errorMsg.className = 'fixed bottom-4 left-4 right-4 bg-red-500/90 text-white px-4 py-3 rounded-lg shadow-lg z-50';
                errorMsg.textContent = 'Please fill in all required fields.';
                document.body.appendChild(errorMsg);
                setTimeout(() => errorMsg.remove(), 3000);
            }
        });
    });
};

const initSuccessToast = () => {
    const toast = document.getElementById('success-toast');
    if (toast) {
        setTimeout(() => {
            toast.classList.add('animate-fade-out');
            setTimeout(() => toast.remove(), 500);
        }, 5000);
    }
};

const initWhatsAppButtons = () => {
    document.querySelectorAll('a[href^="https://wa.me"]').forEach(link => {
        link.target = '_blank';
        link.rel = 'noopener noreferrer';
    });
};

const initReadMore = () => {
    const mobileQuery = window.matchMedia('(max-width: 1023.98px)');

    document.querySelectorAll('.read-more-toggle').forEach(toggle => {
        const description = document.getElementById(toggle.getAttribute('aria-controls'));
        if (!description) return;

        const label = toggle.querySelector('span');
        let expanded = false;

        const measure = () => {
            if (!mobileQuery.matches) {
                description.classList.remove('is-collapsed');
                toggle.classList.add('hidden');
                return;
            }

            // Measure the full copy vs. the 3-line clamp to avoid showing an empty toggle.
            description.classList.add('is-collapsed');
            const collapsedHeight = description.clientHeight;
            description.classList.remove('is-collapsed');
            const fullHeight = description.clientHeight;
            const overflows = fullHeight > collapsedHeight + 4;

            description.classList.toggle('is-collapsed', overflows && !expanded);
            toggle.classList.toggle('hidden', !overflows);
        };

        toggle.addEventListener('click', () => {
            expanded = !expanded;
            description.classList.toggle('is-collapsed', !expanded);
            toggle.setAttribute('aria-expanded', String(expanded));
            if (label) label.textContent = expanded ? 'Read Less' : 'Read More';

            if (!expanded) {
                const top = description.getBoundingClientRect().top + window.pageYOffset - 100;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        });

        mobileQuery.addEventListener('change', () => {
            expanded = false;
            if (label) label.textContent = 'Read More';
            toggle.setAttribute('aria-expanded', 'false');
            measure();
        });

        measure();
    });
};

const initSmoothScroll = () => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                const offset = 80;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top: targetPosition, behavior: 'smooth' });
            }
        });
    });
};

const initWebsiteAnimations = () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-up');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.group, .card, .animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
};

const initAdminSidebar = () => {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (!sidebarToggle || !sidebar) return;

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', function() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
};

const initAdminForms = () => {
    const forms = document.querySelectorAll('#admin-form, .admin-form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]:not([disabled])');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Processing...';
            }
        });
    });
};

const initSelectAll = () => {
    document.querySelectorAll('.select-all-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkboxes = this.closest('.admin-table-container')?.querySelectorAll('.item-checkbox');
            if (checkboxes) {
                checkboxes.forEach(cb => cb.checked = this.checked);
            }
        });
    });
};

const initDeleteConfirmations = () => {
    document.querySelectorAll('[data-action="delete"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            const message = this.dataset.message || 'Are you sure you want to delete this item?';

            if (confirm(message)) {
                window.location.href = url;
            }
        });
    });
};

window.addEventListener('load', function() {
    initLazyImages();
    initLightbox();
    initFormValidation();
    initSuccessToast();
    initWhatsAppButtons();
    initReadMore();
    initSmoothScroll();
    initWebsiteAnimations();
    initAdminSidebar();
    initAdminForms();
    initSelectAll();
    initDeleteConfirmations();
});

window.addEventListener('resize', function() {
    if (window.innerWidth >= 1024) {
        const overlay = document.getElementById('sidebar-overlay');
        if (overlay) overlay.classList.add('hidden');
        const sidebar = document.getElementById('admin-sidebar');
        if (sidebar) sidebar.classList.remove('-translate-x-full');
    }
});
