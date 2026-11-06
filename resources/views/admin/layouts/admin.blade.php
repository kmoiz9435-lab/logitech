<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background-color: #101D2D;
            color: #F4F6F8;
        }

        .admin-layout {
            min-height: 100vh;
            background: linear-gradient(135deg, #101D2D 0%, #0F1928 100%);
        }

        .admin-sidebar {
            width: var(--sidebar-width);
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            max-width: 100vw;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .admin-sidebar, .admin-sidebar * { word-break: break-word; overflow-wrap: break-word; }

        .admin-sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .admin-sidebar.collapsed .sidebar-text {
            opacity: 0;
            transform: translateX(-10px);
            pointer-events: none;
            display: none;
        }

        .admin-sidebar.collapsed .sidebar-tooltip {
            opacity: 1;
            transform: translateX(0);
        }

        .admin-main {
            flex: 1;
            min-width: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .admin-sidebar.collapsed .sidebar-logo { justify-content: center; padding-left: 0; padding-right: 0; }
        .admin-sidebar.collapsed .sidebar-logo img { display: none; }
        .admin-sidebar.collapsed .sidebar-logo button span { display: none; }
        .admin-sidebar.collapsed .sidebar-section { display: none; }
        .admin-sidebar.collapsed .nav-item { justify-content: center; padding-left: 0; padding-right: 0; }
        .admin-sidebar.collapsed nav { padding-left: 8px; padding-right: 8px; }

        .admin-content {
            background: rgba(15, 25, 40, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(56, 89, 135, 0.2);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }

        .nav-item {
            position: relative;
            transition: all 0.2s ease;
        }

        .nav-item:hover {
            background: rgba(56, 89, 135, 0.2);
        }

        .nav-item.active {
            background: rgba(214, 168, 75, 0.15);
            color: #D6A84B;
            border-right: 3px solid #D6A84B;
        }

        .nav-item i {
            width: 24px;
            text-align: center;
            font-size: 1.1rem;
        }

        .sidebar-tooltip {
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%) translateX(-10px);
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            background: rgba(16, 29, 45, 0.95);
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid rgba(56, 89, 135, 0.5);
            white-space: nowrap;
            z-index: 50;
        }

        .admin-sidebar:hover .sidebar-tooltip { opacity: 0 !important; pointer-events: none !important; transform: none !important; }
        .sidebar-tooltip { display: none !important; }

        .admin-header {
            background: rgba(16, 29, 45, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(56, 89, 135, 0.2);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
        }

        .admin-card {
            background: rgba(15, 25, 40, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(56, 89, 135, 0.2);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .admin-card:hover {
            border-color: rgba(214, 168, 75, 0.3);
            box-shadow: 0 8px 30px rgba(214, 168, 75, 0.1);
        }

        .form-input {
            background: rgba(16, 29, 45, 0.6);
            border: 1px solid rgba(56, 89, 135, 0.3);
            color: #F4F6F8;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #D6A84B;
            box-shadow: 0 0 0 3px rgba(214, 168, 75, 0.1);
            background: rgba(16, 29, 45, 0.8);
        }

        .btn-primary {
            background: linear-gradient(135deg, #D6A84B 0%, #E8BC56 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(214, 168, 75, 0.3);
        }

        .btn-primary:hover:not(:disabled) {
            background: linear-gradient(135deg, #E8BC56 0%, #D6A84B 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(214, 168, 75, 0.4);
        }

        .btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-secondary {
            background: rgba(56, 89, 135, 0.3);
            border: 1px solid rgba(56, 89, 135, 0.5);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(56, 89, 135, 0.5);
            border-color: rgba(56, 89, 135, 0.7);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: rgba(220, 38, 38, 0.2);
            border: 1px solid rgba(220, 38, 38, 0.4);
            transition: all 0.3s ease;
        }

        .btn-danger:hover:not(:disabled) {
            background: rgba(220, 38, 38, 0.3);
            border-color: rgba(220, 38, 38, 0.6);
            transform: translateY(-1px);
        }

        .text-gradient {
            background: linear-gradient(135deg, #D6A84B 0%, #F07832 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge-new { background: rgba(239, 68, 68, 0.2); color: #FCA5A5; border: 1px solid rgba(239, 68, 68, 0.4); }
        .status-badge-in_progress { background: rgba(59, 130, 246, 0.2); color: #93C5FD; border: 1px solid rgba(59, 130, 246, 0.4); }
        .status-badge-contacted { background: rgba(16, 185, 129, 0.2); color: #6EE7B7; border: 1px solid rgba(16, 185, 129, 0.4); }
        .status-badge-converted { background: rgba(16, 185, 129, 0.2); color: #34D399; border: 1px solid rgba(16, 185, 129, 0.4); }
        .status-badge-closed { background: rgba(107, 114, 128, 0.2); color: #D1D5DB; border: 1px solid rgba(107, 114, 128, 0.4); }

        .stat-card {
            background: rgba(16, 29, 45, 0.6);
            border: 1px solid rgba(56, 89, 135, 0.2);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(214, 168, 75, 0.3);
            box-shadow: 0 10px 30px rgba(214, 168, 75, 0.1);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .sidebar-logo {
            padding: 20px;
            border-bottom: 1px solid rgba(56, 89, 135, 0.2);
            transition: all 0.3s ease;
        }

        .admin-sidebar.collapsed .sidebar-logo {
            padding: 16px;
        }

        .sidebar-logo img {
            height: 40px;
            width: auto;
            transition: all 0.3s ease;
        }

        .admin-sidebar.collapsed .sidebar-logo img {
            height: 32px;
        }

        .admin-content-area {
            padding: 32px;
        }

        @media (max-width: 1023px) {
            .admin-sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 60;
                height: 100vh;
                top: 0;
                left: 0;
            }

            .admin-sidebar.mobile-open {
                transform: translateX(0);
                box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            }

            .admin-main {
                margin-left: 0 !important;
            }
        }

        .table-row-hover {
            transition: all 0.2s ease;
        }

        .table-row-hover:hover {
            background: rgba(56, 89, 135, 0.1) !important;
            border-color: rgba(56, 89, 135, 0.3) !important;
        }

        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: rgba(56, 89, 135, 0.5) transparent;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(56, 89, 135, 0.5);
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(56, 89, 135, 0.7);
        }

        .loading-shimmer {
            background: linear-gradient(90deg, rgba(56, 89, 135, 0.1), rgba(56, 89, 135, 0.3), rgba(56, 89, 135, 0.1));
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            margin-right: 4px;
            margin-bottom: 4px;
        }

        .badge-category { background: rgba(56, 89, 135, 0.2); color: #93C5FD; border: 1px solid rgba(56, 89, 135, 0.4); }
        .badge-featured { background: rgba(214, 168, 75, 0.2); color: #FDE047; border: 1px solid rgba(214, 168, 75, 0.5); }
        .badge-active { background: rgba(16, 185, 129, 0.2); color: #6EE7B7; border: 1px solid rgba(16, 185, 129, 0.4); }
        .badge-inactive { background: rgba(107, 114, 128, 0.2); color: #D1D5DB; border: 1px solid rgba(107, 114, 128, 0.4); }

        input[type="checkbox"].custom-checkbox {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(56, 89, 135, 0.5);
            border-radius: 4px;
            background: transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        input[type="checkbox"].custom-checkbox:checked {
            background: #D6A84B;
            border-color: #D6A84B;
        }

        input[type="checkbox"].custom-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 1px;
            width: 5px;
            height: 10px;
            border: solid #101D2D;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .tab-active {
            background: rgba(214, 168, 75, 0.15);
            color: #D6A84B;
            border-bottom: 2px solid #D6A84B;
        }

        .tab-inactive {
            background: transparent;
            color: #9CA3AF;
            border-bottom: 2px solid transparent;
        }

        .tab-inactive:hover {
            background: rgba(56, 89, 135, 0.1);
            color: #F4F6F8;
        }
    .nav-item { position: relative; padding-right: 1rem; }
    .nav-item::before { content:''; position:absolute; left:0; top:50%; transform:translateY(-50%); width:3px; height:0; background:#D6A84B; border-radius:0 4px 4px 0; transition:height .2s; }
    .nav-item.active::before { height:70%; }
    .nav-item.active { background: rgba(214,168,75,0.08); color:#fff; }
    .sidebar-logo img { max-height:36px; width:auto; filter:drop-shadow(0 2px 4px rgba(214,168,75,0.2)); }
</style>
</head>
<body class="admin-layout">
    <div class="flex min-h-screen relative">
        <!-- Sidebar Overlay for Mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-40 hidden lg:hidden transition-opacity"></div>

        <!-- Sidebar Navigation -->
        <aside id="admin-sidebar" class="admin-sidebar z-50 bg-[#0F1928] border-r border-[#183B56]/30 overflow-y-auto custom-scrollbar">
            <div class="sidebar-logo flex items-center justify-between gap-2 px-4 py-3">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logic Tech Logo" class="h-9 w-auto object-contain">
                <button onclick="document.getElementById('admin-sidebar').classList.toggle('collapsed')" class="shrink-0 text-[#D6A84B] bg-[#D6A84B]/10 hover:bg-[#D6A84B]/25 border border-[#D6A84B]/30 px-2.5 py-1.5 rounded-lg text-xs font-semibold transition flex items-center gap-1.5" title="Toggle Sidebar">
                    <i class="fa-solid fa-bars-staggered text-sm"></i>
                    <span>Collapse</span>
                </button>
            </div>

            <nav class="px-3 space-y-1">
                <div class="sidebar-section px-3 py-2">
                    <div class="sidebar-text text-xs font-semibold text-[#9CA3AF] uppercase tracking-wider mb-2">Main Menu</div>
                </div>

                <a href="{{ route('admin.dashboard') }}" class="nav-item group flex items-center px-4 py-3 text-[#F4F6F8]/80 hover:text-white rounded-lg transition-all mb-1 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high group-hover:text-[#D6A84B]"></i>
                    <span class="sidebar-text ml-3 font-medium">Dashboard</span>
                    <span class="sidebar-tooltip">Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}" class="nav-item group flex items-center px-4 py-3 text-[#F4F6F8]/80 hover:text-white rounded-lg transition-all mb-1 {{ request()->routeIs('admin.products.*') && !request()->routeIs('admin.products.create') ? 'active' : '' }}">
                    <i class="fa-solid fa-cubes group-hover:text-[#D6A84B]"></i>
                    <span class="sidebar-text ml-3 font-medium">Products</span>
                    <span class="sidebar-tooltip">Products</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="nav-item group flex items-center px-4 py-3 text-[#F4F6F8]/80 hover:text-white rounded-lg transition-all mb-1 {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-folder group-hover:text-[#D6A84B]"></i>
                    <span class="sidebar-text ml-3 font-medium">Categories</span>
                    <span class="sidebar-tooltip">Categories</span>
                </a>

                <a href="{{ route('admin.industries.index') }}" class="nav-item group flex items-center px-4 py-3 text-[#F4F6F8]/80 hover:text-white rounded-lg transition-all mb-1 {{ request()->routeIs('admin.industries.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-industry group-hover:text-[#D6A84B]"></i>
                    <span class="sidebar-text ml-3 font-medium">Industries</span>
                    <span class="sidebar-tooltip">Industries</span>
                </a>

                <a href="{{ route('admin.why-choose.index') }}" class="nav-item group flex items-center px-4 py-3 text-[#F4F6F8]/80 hover:text-white rounded-lg transition-all mb-1 {{ request()->routeIs('admin.why-choose.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-star group-hover:text-[#D6A84B]"></i>
                    <span class="sidebar-text ml-3 font-medium">Why Choose Us</span>
                    <span class="sidebar-tooltip">Why Choose Us</span>
                </a>

                <a href="{{ route('admin.gallery.index') }}" class="nav-item group flex items-center px-4 py-3 text-[#F4F6F8]/80 hover:text-white rounded-lg transition-all mb-1 {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-images group-hover:text-[#D6A84B]"></i>
                    <span class="sidebar-text ml-3 font-medium">Gallery</span>
                    <span class="sidebar-tooltip">Gallery</span>
                </a>

                <div class="sidebar-section px-3 py-2 mt-4">
                    <div class="sidebar-text text-xs font-semibold text-[#9CA3AF] uppercase tracking-wider mb-2">Content Management</div>
                </div>

                <a href="{{ route('admin.content.edit') }}" class="nav-item group flex items-center px-4 py-3 text-[#F4F6F8]/80 hover:text-white rounded-lg transition-all mb-1 {{ request()->routeIs('admin.content.edit') ? 'active' : '' }}">
                    <i class="fa-solid fa-pencil-alt group-hover:text-[#D6A84B]"></i>
                    <span class="sidebar-text ml-3 font-medium">Website Content</span>
                    <span class="sidebar-tooltip">Website Content</span>
                </a>

                <a href="{{ route('admin.settings.edit') }}" class="nav-item group flex items-center px-4 py-3 text-[#F4F6F8]/80 hover:text-white rounded-lg transition-all mb-1 {{ request()->routeIs('admin.settings.edit') ? 'active' : '' }}">
                    <i class="fa-solid fa-cog group-hover:text-[#D6A84B]"></i>
                    <span class="sidebar-text ml-3 font-medium">Company Settings</span>
                    <span class="sidebar-tooltip">Company Settings</span>
                </a>

                <div class="sidebar-section px-3 py-2 mt-4">
                    <div class="sidebar-text text-xs font-semibold text-[#9CA3AF] uppercase tracking-wider mb-2">Customer Relations</div>
                </div>

                <a href="{{ route('admin.inquiries.index') }}" class="nav-item group flex items-center px-4 py-3 text-[#F4F6F8]/80 hover:text-white rounded-lg transition-all mb-1 {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-envelope group-hover:text-[#D6A84B]"></i>
                    <span class="sidebar-text ml-3 font-medium">Customer Inquiries</span>
                    <span class="sidebar-tooltip">Customer Inquiries</span>
                </a>

                <a href="{{ route('admin.profile.edit') }}" class="nav-item group flex items-center px-4 py-3 text-[#F4F6F8]/80 hover:text-white rounded-lg transition-all mb-1 {{ request()->routeIs('admin.profile.edit') ? 'active' : '' }}">
                    <i class="fa-solid fa-user group-hover:text-[#D6A84B]"></i>
                    <span class="sidebar-text ml-3 font-medium">Admin Profile</span>
                    <span class="sidebar-tooltip">Admin Profile</span>
                </a>
            </nav>

            <div class="px-4 py-4 border-t border-[#183B56]/20 mt-auto">
                <a href="{{ route('admin.logout') }}" class="nav-item group flex items-center px-4 py-3 text-[#F4F6F8]/80 hover:text-red-400 transition-colors">
                    <i class="fa-solid fa-right-from-bracket group-hover:text-red-400"></i>
                    <span class="sidebar-text ml-3 font-medium">Logout</span>
                    <span class="sidebar-tooltip">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="admin-main">
            <!-- Header -->
            <header class="admin-header z-30">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center gap-4">
                        <button id="sidebar-toggle" class="lg:hidden p-2 text-[#F4F6F8] hover:text-[#D6A84B] transition-colors">
                            <i class="fa-solid fa-bars text-xl"></i>
                        </button>
                        <button id="sidebar-collapse" class="hidden lg:flex p-2 text-[#F4F6F8] hover:text-[#D6A84B] transition-colors">
                            <i class="fa-solid fa-bars-staggered text-xl"></i>
                        </button>

                        <div>
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Logic Tech" class="h-10 w-auto mb-1 object-contain">
                            <h1 class="text-xl md:text-2xl font-bold text-white">
                                @yield('page_title', 'Dashboard')
                            </h1>
                            <p class="text-sm text-[#9CA3AF] mt-1">
                                @yield('page_description', 'Welcome to Admin Panel')
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ url('/') }}" target="_blank" class="hidden sm:inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-[#183B56]/50 text-[#D6A84B] hover:bg-[#D6A84B]/20 hover:text-white text-sm font-medium transition border border-[#1B2845]">
                            <i class="fa-solid fa-globe"></i> Website
                        </a>
                        <div class="hidden md:block text-right">
                            <div class="text-sm font-medium text-white">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-[#9CA3AF]">{{ auth()->user()->email }}</div>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-[#D6A84B] to-[#E8BC56] rounded-full flex items-center justify-center">
                            <span class="text-[#101D2D] font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="admin-content-area custom-scrollbar overflow-x-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Sidebar toggle and collapse functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('admin-sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const sidebarCollapse = document.getElementById('sidebar-collapse');

            // Mobile sidebar toggle
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('mobile-open');
                    sidebarOverlay.classList.toggle('hidden');
                });
            }

            // Overlay click to close sidebar
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('mobile-open');
                    sidebarOverlay.classList.add('hidden');
                });
            }

            // Sidebar collapse for desktop
            if (sidebarCollapse) {
                sidebarCollapse.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                });
            }

            // Close mobile sidebar on window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('mobile-open');
                    sidebarOverlay.classList.add('hidden');
                }
            });

            // Active nav item highlighting
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    navItems.forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
