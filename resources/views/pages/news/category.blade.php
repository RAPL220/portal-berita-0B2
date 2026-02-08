@extends('layouts.app')

@section('title', $category->title)

@section('content')

    <style>
        :root {
            --primary-blue: #0B7ABD;
            --primary-blue-dark: #0A5A8F;
            --primary-blue-light: #1E9AD6;
            --accent-blue: #3BB5E8;
            --gradient-blue-start: #0E86C9;
            --gradient-blue-end: #0B5F96;
            --dark-blue: #1E293B;
            --text-dark: #0F172A;
            --text-gray: #64748B;
            --bg-light: #F8FAFC;
            --border-light: #E2E8F0;
            --white: #FFFFFF;
        }

        /* Category Header */
        .category-header-wrapper {
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            padding: 5rem 0 6rem;
            position: relative;
            overflow: hidden;
        }

        .category-header-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .category-header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .category-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .category-breadcrumb a {
            color: white;
            text-decoration: none;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .category-breadcrumb a:hover {
            opacity: 1;
        }

        .category-breadcrumb-separator {
            opacity: 0.6;
        }

        .category-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .category-title {
            font-size: 3.5rem;
            font-weight: 900;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .category-description {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 700px;
            margin: 0 auto 1.5rem;
            line-height: 1.6;
        }

        .category-meta {
            display: inline-flex;
            align-items: center;
            gap: 1.5rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            border-radius: 50px;
            color: white;
            font-size: 0.95rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meta-icon {
            width: 20px;
            height: 20px;
        }

        /* Category Content */
        .category-content {
            max-width: 1400px;
            margin: -3rem auto 4rem;
            padding: 0 2rem;
            position: relative;
            z-index: 10;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            border-radius: 20px;
            padding: 1.5rem 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .filter-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .filter-label {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .filter-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            border: 2px solid var(--border-light);
            background: white;
            color: var(--text-gray);
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            border-color: var(--primary-blue);
            color: var(--primary-blue);
            background: rgba(11, 122, 189, 0.05);
        }

        .filter-btn.active {
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            border-color: transparent;
            color: white;
            box-shadow: 0 4px 15px rgba(11, 122, 189, 0.3);
        }

        .view-toggle {
            display: flex;
            gap: 0.5rem;
        }

        .view-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 2px solid var(--border-light);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-gray);
        }

        .view-btn:hover {
            border-color: var(--primary-blue);
            color: var(--primary-blue);
        }

        .view-btn.active {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
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
            border-radius: 20px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(11, 122, 189, 0.2);
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
            transform: scale(1.1);
        }

        .news-card-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--primary-blue);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            font-weight: 800;
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
            border-top: 1px solid var(--border-light);
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
            border-radius: 50%;
            border: 2px solid var(--primary-blue);
            object-fit: cover;
        }

        .author-name-small {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .news-card-date {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            color: var(--text-gray);
            font-size: 0.8rem;
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
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .empty-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, rgba(14, 134, 201, 0.1) 0%, rgba(11, 95, 150, 0.1) 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-blue);
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }

        .empty-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
        }

        .empty-description {
            font-size: 1rem;
            color: var(--text-gray);
            max-width: 500px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        .empty-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.85rem 2rem;
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(11, 122, 189, 0.3);
            transition: all 0.3s ease;
        }

        .empty-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(11, 122, 189, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .news-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 1024px) {
            .category-header-wrapper {
                padding: 4rem 0 5rem;
            }

            .category-title {
                font-size: 2.5rem;
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
                padding: 3rem 0 4rem;
            }

            .category-header-container {
                padding: 0 1.5rem;
            }

            .category-icon {
                width: 60px;
                height: 60px;
                font-size: 2rem;
            }

            .category-title {
                font-size: 2rem;
            }

            .category-description {
                font-size: 1rem;
            }

            .category-meta {
                flex-direction: column;
                gap: 0.75rem;
                padding: 0.75rem 1.5rem;
            }

            .category-content {
                padding: 0 1.5rem;
                margin-top: -2rem;
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

            .empty-icon {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
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
                <a href="{{ route('landing') }}">Beranda</a>
                <span class="category-breadcrumb-separator">/</span>
                <span>Kategori</span>
                <span class="category-breadcrumb-separator">/</span>
                <span>{{ $category->title }}</span>
            </div>

            <!-- Category Icon -->
            <div class="category-icon fade-in-up">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="50" height="50">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>

            <!-- Category Title -->
            <h1 class="category-title fade-in-up">{{ $category->title }}</h1>

            <!-- Category Description (if you have it in your model) -->
            <p class="category-description fade-in-up">
                Temukan berita terkini dan terpercaya seputar {{ $category->title }}
            </p>

            <!-- Category Meta -->
            <div class="category-meta fade-in-up">
                <div class="meta-item">
                    <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <span><strong>{{ $category->news->count() }}</strong> Artikel</span>
                </div>
                <div class="meta-item">
                    <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Diperbarui
                        {{ \Carbon\Carbon::parse($category->news->first()?->created_at ?? now())->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Content -->
    <div class="category-content">
        <!-- Filter Section -->
        <div class="filter-section fade-in-up">
            <div class="filter-left">
                <span class="filter-label">Urutkan:</span>
                <div class="filter-buttons">
                    <button class="filter-btn active" onclick="sortNews('latest')">Terbaru</button>
                    <button class="filter-btn" onclick="sortNews('popular')">Terpopuler</button>
                    <button class="filter-btn" onclick="sortNews('oldest')">Terlama</button>
                </div>
            </div>
            <div class="view-toggle">
                <button class="view-btn active" onclick="toggleView('grid')" title="Tampilan Grid">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </button>
                <button class="view-btn" onclick="toggleView('list')" title="Tampilan List">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
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
                            <span class="news-card-badge">{{ $category->title }}</span>
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
                <div class="empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="60" height="60">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h2 class="empty-title">Belum Ada Artikel</h2>
                <p class="empty-description">
                    Saat ini belum ada artikel dalam kategori {{ $category->title }}.
                    Silakan kembali lagi nanti atau jelajahi kategori lainnya.
                </p>
                <a href="{{ route('landing') }}" class="empty-btn">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Kembali ke Beranda
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
            // For now, we'll just show a console log
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
