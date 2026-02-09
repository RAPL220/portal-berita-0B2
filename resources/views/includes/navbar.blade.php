<!-- Navigation Bar -->
<nav class="navbar sticky top-0 z-50" id="navbar">
    <div class="nav-top-bar"></div>

    <div class="nav-container">
        <div class="nav-content">
            <!-- Logo Section -->
            <div class="logo-wrapper-nav">
                <a href="{{ route('landing') }}" class="logo-link">
                    <div class="logo-container">
                        <img id="logo_navbar" src="{{ asset('/asset/img/logo_fokuskito.png') }}" alt="Fokus Kito Logo">
                    </div>
                </a>

                <!-- Mobile Menu Toggle -->
                <button class="menu-toggle" id="menu-toggle" aria-label="Toggle menu">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>

            <!-- Navigation Menu -->
            <div class="nav-menu-wrapper" id="menu">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('landing') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>BERANDA</span>
                        </a>
                    </li>
                    @foreach (\App\Models\Categories::all() as $category)
                        <li class="nav-item">
                            <a href="{{ route('news.category', $category->slug) }}"
                                class="nav-link {{ request()->is('news/category/' . $category->slug) ? 'active' : '' }}">
                                <span>{{ strtoupper($category->title) }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Search and Actions -->
            <div class="nav-actions">
                <!-- Search Box -->
                <div class="search-container">
                    <form action="{{ route('news.index') }}" method="GET" class="search-form">
                        <div class="search-box">
                            <input name="search" type="text" placeholder="CARI BERITA..." class="search-input"
                                id="searchInput" />
                            <button type="submit" class="search-button">
                                <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Login Button -->
                <a href="/admin" class="btn-login">
                    <svg class="login-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>MASUK</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile Search (appears when menu is open) -->
    <div class="mobile-search" id="mobile-search">
        <form action="{{ route('news.index') }}" method="GET" class="mobile-search-form">
            <div class="mobile-search-box">
                <input name="search" type="text" placeholder="CARI BERITA..." class="mobile-search-input" />
                <button type="submit" class="mobile-search-button">
                    <svg class="mobile-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</nav>

<style>
    :root {
        --primary-red: #E63946;
        --primary-red-dark: #D62828;
        --dark-bg: #1D3557;
        --text-dark: #14213D;
        --text-gray: #6C757D;
        --bg-light: #F1FAEE;
        --white: #FFFFFF;
    }

    /* Navbar Main Container */
    .navbar {
        background: var(--white);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .navbar.scrolled {
        box-shadow: 0 6px 30px rgba(230, 57, 70, 0.15);
    }

    /* Top Red Bar */
    .nav-top-bar {
        height: 4px;
        background: var(--primary-red);
        width: 100%;
    }

    /* Nav Container */
    .nav-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .nav-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 0;
        gap: 2rem;
    }

    /* Logo Section */
    .logo-wrapper-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .logo-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .logo-link:hover {
        transform: scale(1.05);
    }

    .logo-container {
        display: flex;
        align-items: center;
        padding: 0.25rem 0;
    }

    #logo_navbar {
        height: 42px;
        width: auto;
        display: block;
        transition: transform 0.3s ease;
    }

    /* Mobile Menu Toggle */
    .menu-toggle {
        display: none;
        flex-direction: column;
        gap: 5px;
        background: none;
        border: 2px solid var(--primary-red);
        cursor: pointer;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .menu-toggle:hover {
        background: var(--primary-red);
    }

    .menu-toggle:hover .hamburger-line {
        background: white;
    }

    .hamburger-line {
        width: 24px;
        height: 3px;
        background: var(--primary-red);
        transition: all 0.3s ease;
    }

    .menu-toggle.active {
        background: var(--primary-red);
    }

    .menu-toggle.active .hamburger-line {
        background: white;
    }

    .menu-toggle.active .hamburger-line:nth-child(1) {
        transform: rotate(45deg) translate(6px, 6px);
    }

    .menu-toggle.active .hamburger-line:nth-child(2) {
        opacity: 0;
    }

    .menu-toggle.active .hamburger-line:nth-child(3) {
        transform: rotate(-45deg) translate(6px, -6px);
    }

    /* Navigation Menu */
    .nav-menu-wrapper {
        flex: 1;
        display: flex;
        justify-content: center;
    }

    .nav-menu {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-item {
        position: relative;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.25rem;
        color: var(--text-dark);
        text-decoration: none;
        font-weight: 800;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        position: relative;
        border: 2px solid transparent;
    }

    .nav-icon {
        width: 16px;
        height: 16px;
        stroke-width: 2.5;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 3px;
        background: var(--primary-red);
        transition: width 0.3s ease;
    }

    .nav-link:hover {
        color: var(--primary-red);
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .nav-link.active {
        color: white;
        background: var(--primary-red);
        border-color: var(--primary-red);
    }

    .nav-link.active::after {
        display: none;
    }

    .nav-link.active .nav-icon {
        color: white;
    }

    /* Search and Actions */
    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    /* Search Box */
    .search-container {
        position: relative;
    }

    .search-box {
        position: relative;
        display: flex;
        align-items: center;
        border: 2px solid var(--text-gray);
        transition: all 0.3s ease;
    }

    .search-box:focus-within {
        border-color: var(--primary-red);
    }

    .search-input {
        width: 200px;
        padding: 0.7rem 1rem;
        border: none;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: var(--text-dark);
        background: white;
        transition: all 0.3s ease;
        outline: none;
    }

    .search-input::placeholder {
        color: var(--text-gray);
        font-weight: 700;
    }

    .search-input:focus {
        width: 260px;
    }

    .search-button {
        width: 42px;
        height: 42px;
        background: var(--primary-red);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .search-button:hover {
        background: var(--primary-red-dark);
    }

    .search-icon {
        width: 18px;
        height: 18px;
        color: white;
        stroke-width: 2.5;
    }

    /* Login Button */
    .btn-login {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.75rem;
        background: var(--dark-bg);
        color: white;
        text-decoration: none;
        font-weight: 900;
        font-size: 0.8rem;
        letter-spacing: 1px;
        border: 2px solid var(--dark-bg);
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .login-icon {
        width: 18px;
        height: 18px;
        stroke-width: 2.5;
    }

    .btn-login:hover {
        background: transparent;
        color: var(--dark-bg);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(29, 53, 87, 0.3);
    }

    /* Mobile Search */
    .mobile-search {
        display: none;
        padding: 0 2rem 1rem;
        background: white;
        border-top: 3px solid var(--primary-red);
    }

    .mobile-search.active {
        display: block;
    }

    .mobile-search-box {
        position: relative;
        display: flex;
        align-items: center;
        border: 2px solid var(--text-gray);
    }

    .mobile-search-input {
        width: 100%;
        padding: 0.85rem 1rem;
        border: none;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: var(--text-dark);
        background: white;
        outline: none;
        transition: all 0.3s ease;
    }

    .mobile-search-input::placeholder {
        color: var(--text-gray);
        font-weight: 700;
    }

    .mobile-search-input:focus {
        border-color: var(--primary-red);
    }

    .mobile-search-button {
        width: 48px;
        height: 48px;
        background: var(--primary-red);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .mobile-search-button:hover {
        background: var(--primary-red-dark);
    }

    .mobile-search-icon {
        width: 20px;
        height: 20px;
        color: white;
        stroke-width: 2.5;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .menu-toggle {
            display: flex;
        }

        .nav-container {
            padding: 0 1.5rem;
        }

        .nav-menu-wrapper {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 1.5rem;
            display: none;
            border-top: 3px solid var(--primary-red);
        }

        .nav-menu-wrapper.active {
            display: block;
        }

        .nav-menu {
            flex-direction: column;
            gap: 0.5rem;
            width: 100%;
        }

        .nav-item {
            width: 100%;
        }

        .nav-link {
            width: 100%;
            padding: 0.9rem 1.25rem;
            border: 2px solid var(--text-gray);
        }

        .nav-link:hover {
            border-color: var(--primary-red);
        }

        .nav-link.active {
            border-color: var(--primary-red);
        }

        .nav-link::after {
            display: none;
        }

        .nav-actions {
            display: none;
        }

        .mobile-search.active {
            display: block;
        }
    }

    @media (max-width: 768px) {
        .nav-container {
            padding: 0 1rem;
        }

        .nav-content {
            padding: 0.75rem 0;
        }

        #logo_navbar {
            height: 36px;
        }

        .nav-link {
            font-size: 0.75rem;
        }
    }

    @media (max-width: 640px) {
        .nav-menu-wrapper {
            padding: 1rem;
        }

        .mobile-search {
            padding: 0 1rem 1rem;
        }

        #logo_navbar {
            height: 32px;
        }
    }

    /* Scroll Animation */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .nav-menu-wrapper.active {
        animation: slideDown 0.3s ease-out;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');
        const mobileSearch = document.getElementById('mobile-search');
        const navbar = document.getElementById('navbar');

        if (menuToggle && menu) {
            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                menuToggle.classList.toggle('active');
                menu.classList.toggle('active');
                mobileSearch.classList.toggle('active');

                // Prevent body scroll when menu is open
                if (menu.classList.contains('active')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            });
        }

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = navbar.contains(event.target);
            if (!isClickInside && menu && menu.classList.contains('active')) {
                menuToggle.classList.remove('active');
                menu.classList.remove('active');
                mobileSearch.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Close menu when clicking on a link
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 1024) {
                    menuToggle.classList.remove('active');
                    menu.classList.remove('active');
                    mobileSearch.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });

        // Navbar Scroll Effect
        let lastScroll = 0;
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        });

        // Search input animation
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('focus', function() {
                this.parentElement.parentElement.style.transform = 'scale(1.02)';
            });

            searchInput.addEventListener('blur', function() {
                this.parentElement.parentElement.style.transform = 'scale(1)';
            });
        }

        // Prevent form submission on empty search
        const searchForms = document.querySelectorAll('.search-form, .mobile-search-form');
        searchForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const input = this.querySelector('input[name="search"]');
                if (!input.value.trim()) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
