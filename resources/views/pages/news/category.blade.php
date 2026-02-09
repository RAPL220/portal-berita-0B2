@extends('layouts.app')

@section('title', $category->title)

@section('content')

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

        /* Category Header */
        .category-header-wrapper {
            background: var(--dark-bg);
            padding: 4rem 0;
            position: relative;
            border-bottom: 6px solid var(--primary-red);
        }

        .category-header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }

        .category-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.6rem 1.5rem;
            color: white;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .category-breadcrumb a {
            color: white;
            text-decoration: none;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .category-breadcrumb a:hover {
            opacity: 1;
        }

        .category-breadcrumb-separator {
            color: var(--primary-red);
            font-weight: 900;
        }

        .category-header-content {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .category-icon-box {
            width: 100px;
            height: 100px;
            background: var(--primary-red);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            flex-shrink: 0;
            box-shadow: 0 8px 30px rgba(230, 57, 70, 0.4);
        }

        .category-header-text {
            flex: 1;
        }

        .category-title {
            font-size: 3rem;
            font-weight: 900;
            color: white;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .category-description {
            font-size: 1.1rem;
            color: #94A3B8;
            line-height: 1.6;
            font-weight: 600;
        }

        .category-meta-bar {
            background: rgba(255, 255, 255, 0.05);
            padding: 1.5rem 2rem;
            margin-top: 2rem;
            display: flex;
            align-items: center;
            gap: 3rem;
            border-top: 2px solid rgba(255, 255, 255, 0.1);
        }

        .meta-stat {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
        }

        .stat-icon-wrapper {
            width: 40px;
            height: 40px;
            background: var(--primary-red);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon {
            width: 20px;
            height: 20px;
        }

        .stat-content {
            display: flex;
            flex-direction: column;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #94A3B8;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Category Content */
        .category-content {
            max-width: 1400px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            padding: 1.5rem 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem;
            border-left: 6px solid var(--primary-red);
        }

        .filter-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .filter-label {
            font-weight: 900;
            color: var(--text-dark);
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-number {
            width: 28px;
            height: 28px;
            background: var(--primary-red);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 900;
        }

        .filter-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.6rem 1.5rem;
            border: 2px solid var(--text-gray);
            background: white;
            color: var(--text-gray);
            font-weight: 800;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            border-color: var(--primary-red);
            color: var(--primary-red);
        }

        .filter-btn.active {
            background: var(--primary-red);
            border-color: var(--primary-red);
            color: white;
            box-shadow: 0 4px 15px rgba(230, 57, 70, 0.3);
        }

        .view-toggle {
            display: flex;
            gap: 0.5rem;
        }

        .view-btn {
            width: 42px;
            height: 42px;
            border: 2px solid var(--text-gray);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-gray);
        }

        .view-btn:hover {
            border-color: var(--primary-red);
            color: var(--primary-red);
        }

        .view-btn.active {
            background: var(--primary-red);
            border-color: var(--primary-red);
            color: white;
        }

        /* News Grid */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }

        .news-grid.list-view {
            grid-template-columns: 1fr;
        }

        /* News Card */
        .news-card {
            background: white;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            height: 100%;
            border-top: 4px solid var(--primary-red);
        }

        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(230, 57, 70, 0.25);
        }

        .news-card-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .news-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .news-card:hover .news-card-image {
            transform: scale(1.15);
        }

        .news-card-badge {
            position: absolute;
            top: 0;
            left: 0;
            background: var(--primary-red);
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.7rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            z-index: 10;
        }

        .news-card-content {
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .news-card-title {
            font-size: 1.15rem;
            font-weight: 900;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: 0.75rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .news-card-excerpt {
            font-size: 0.9rem;
            color: var(--text-gray);
            line-height: 1.6;
            font-weight: 600;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .news-card-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 2px solid var(--bg-light);
            margin-top: auto;
        }

        .news-card-author {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .author-avatar-small {
            width: 32px;
            height: 32px;
            object-fit: cover;
            border: 2px solid var(--primary-red);
        }

        .author-name-small {
            font-size: 0.8rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .news-card-date {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            color: var(--text-gray);
            font-size: 0.75rem;
            font-weight: 700;
        }

        .date-icon {
            width: 14px;
            height: 14px;
        }

        /* List View Styles */
        .news-grid.list-view .news-card {
            flex-direction: row;
            height: auto;
        }

        .news-grid.list-view .news-card-image-wrapper {
            width: 350px;
            height: 250px;
            flex-shrink: 0;
        }

        .news-grid.list-view .news-card-content {
            padding: 2rem;
        }

        .news-grid.list-view .news-card-title {
            font-size: 1.5rem;
            -webkit-line-clamp: 2;
        }

        .news-grid.list-view .news-card-excerpt {
            -webkit-line-clamp: 3;
            margin-bottom: 1.5rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-top: 6px solid var(--primary-red);
        }

        .empty-icon-box {
            width: 120px;
            height: 120px;
            background: var(--bg-light);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-red);
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }

        .empty-title {
            font-size: 1.75rem;
            font-weight: 900;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .empty-description {
            font-size: 1rem;
            color: var(--text-gray);
            max-width: 500px;
            margin: 0 auto 2rem;
            line-height: 1.6;
            font-weight: 600;
        }

        .empty-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.85rem 2rem;
            background: var(--primary-red);
            color: white;
            text-decoration: none;
            font-weight: 900;
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: 2px solid var(--primary-red);
            transition: all 0.3s ease;
        }

        .empty-btn:hover {
            background: transparent;
            color: var(--primary-red);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(230, 57, 70, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .news-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 1024px) {
            .category-header-wrapper {
                padding: 3rem 0;
            }

            .category-header-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .category-icon-box {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
            }

            .category-title {
                font-size: 2.5rem;
            }

            .category-meta-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.5rem;
            }

            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .news-grid.list-view .news-card {
                flex-direction: column;
            }

            .news-grid.list-view .news-card-image-wrapper {
                width: 100%;
                height: 250px;
            }

            .filter-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-left {
                width: 100%;
                flex-direction: column;
                align-items: flex-start;
            }

            .view-toggle {
                width: 100%;
                justify-content: flex-end;
            }
        }

        @media (max-width: 768px) {
            .category-header-wrapper {
                padding: 2.5rem 0;
            }

            .category-header-container {
                padding: 0 1.5rem;
            }

            .category-icon-box {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }

            .category-title {
                font-size: 2rem;
            }

            .category-description {
                font-size: 1rem;
            }

            .category-content {
                padding: 0 1.5rem;
            }

            .news-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .filter-section {
                padding: 1.25rem 1.5rem;
            }

            .filter-buttons {
                width: 100%;
            }

            .filter-btn {
                flex: 1;
                text-align: center;
            }
        }

        @media (max-width: 640px) {
            .category-header-container {
                padding: 0 1rem;
            }

            .category-title {
                font-size: 1.75rem;
            }

            .category-description {
                font-size: 0.95rem;
            }

            .category-content {
                padding: 0 1rem;
            }

            .filter-section {
                padding: 1rem;
            }

            .news-card-content {
                padding: 1.25rem;
            }

            .empty-state {
                padding: 3rem 1.5rem;
            }

            .empty-icon-box {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
            }

            .stat-value {
                font-size: 1.25rem;
            }

            .category-meta-bar {
                padding: 1rem 1.5rem;
                gap: 1rem;
            }

            .meta-stat {
                gap: 0.5rem;
            }

            .stat-icon-wrapper {
                width: 36px;
                height: 36px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .stagger-1 {
            animation-delay: 0.1s;
        }

        .stagger-2 {
            animation-delay: 0.2s;
        }

        .stagger-3 {
            animation-delay: 0.3s;
        }

        .stagger-4 {
            animation-delay: 0.4s;
        }

        .stagger-5 {
            animation-delay: 0.5s;
        }

        .stagger-6 {
            animation-delay: 0.6s;
        }
    </style>

    <!-- Category Header -->
    <div class="category-header-wrapper">
        <div class="category-header-container">
            <!-- Breadcrumb -->
            <div class="category-breadcrumb fade-in-up">
                <a href="{{ route('landing') }}">BERANDA</a>
                <span class="category-breadcrumb-separator">//</span>
                <span>KATEGORI</span>
                <span class="category-breadcrumb-separator">//</span>
                <span>{{ strtoupper($category->title) }}</span>
            </div>

            <!-- Header Content -->
            <div class="category-header-content fade-in-up">
                <!-- Category Icon -->
                <div class="category-icon-box">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="50" height="50">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>

                <div class="category-header-text">
                    <!-- Category Title -->
                    <h1 class="category-title">{{ strtoupper($category->title) }}</h1>

                    <!-- Category Description -->
                    <p class="category-description">
                        Temukan berita terkini dan terpercaya seputar {{ $category->title }}
                    </p>
                </div>
            </div>

            <!-- Category Meta Bar -->
            <div class="category-meta-bar fade-in-up">
                <div class="meta-stat">
                    <div class="stat-icon-wrapper">
                        <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $category->news->count() }}</div>
                        <div class="stat-label">Artikel</div>
                    </div>
                </div>
                <div class="meta-stat">
                    <div class="stat-icon-wrapper">
                        <svg class="stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">
                            {{ \Carbon\Carbon::parse($category->news->first()?->created_at ?? now())->diffForHumans() }}
                        </div>
                        <div class="stat-label">Diperbarui</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Content -->
    <div class="category-content">
        <!-- Filter Section -->
        <div class="filter-section fade-in-up">
            <div class="filter-left">
                <div class="filter-label">
                    <span class="filter-number">01</span>
                    <span>URUTKAN</span>
                </div>
                <div class="filter-buttons">
                    <button class="filter-btn active" onclick="sortNews('latest')">TERBARU</button>
                    <button class="filter-btn" onclick="sortNews('oldest')">TERLAMA</button>
                    <button class="filter-btn" onclick="sortNews('popular')">POPULER</button>
                </div>
            </div>
            <div class="view-toggle">
                <button class="view-btn active" onclick="toggleView('grid')" title="Grid View">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z" />
                    </svg>
                </button>
                <button class="view-btn" onclick="toggleView('list')" title="List View">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- News Grid -->
        @if ($category->news->count() > 0)
            <div class="news-grid" id="newsGrid">
                @foreach ($category->news as $index => $article)
                    <a href="{{ route('news.show', $article->slug) }}"
                        class="news-card fade-in-up stagger-{{ ($index % 6) + 1 }}">
                        <div class="news-card-image-wrapper">
                            <span class="news-card-badge">{{ strtoupper($category->title) }}</span>
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                                class="news-card-image">
                        </div>
                        <div class="news-card-content">
                            <h3 class="news-card-title">{{ $article->title }}</h3>
                            <div class="news-card-excerpt">{!! Str::limit(strip_tags($article->content), 150) !!}</div>
                            <div class="news-card-meta">
                                <div class="news-card-author">
                                    <img src="{{ asset('storage/' . $article->author->avatar) }}"
                                        alt="{{ $article->author->name }}" class="author-avatar-small">
                                    <span class="author-name-small">{{ $article->author->name }}</span>
                                </div>
                                <div class="news-card-date">
                                    <svg class="date-icon" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state fade-in-up">
                <div class="empty-icon-box">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="60" height="60">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h2 class="empty-title">BELUM ADA ARTIKEL</h2>
                <p class="empty-description">
                    Saat ini belum ada artikel dalam kategori {{ $category->title }}.
                    Silakan kembali lagi nanti atau jelajahi kategori lainnya.
                </p>
                <a href="{{ route('landing') }}" class="empty-btn">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>KEMBALI KE BERANDA</span>
                </a>
            </div>
        @endif
    </div>

    <script>
        // Toggle View (Grid/List)
        function toggleView(view) {
            const newsGrid = document.getElementById('newsGrid');
            const viewButtons = document.querySelectorAll('.view-btn');

            viewButtons.forEach(btn => btn.classList.remove('active'));
            event.target.closest('.view-btn').classList.add('active');

            if (view === 'list') {
                newsGrid.classList.add('list-view');
            } else {
                newsGrid.classList.remove('list-view');
            }
        }

        // Sort News
        function sortNews(sortType) {
            const filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Here you would typically make an AJAX call to re-fetch sorted data
            console.log('Sorting by:', sortType);

            // You can implement actual sorting logic here or redirect with query params
            // window.location.href = `?sort=${sortType}`;
        }

        // Smooth scroll to content
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('scroll')) {
                document.querySelector('.category-content').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    </script>

@endsection
