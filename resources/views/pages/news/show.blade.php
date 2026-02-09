@extends('layouts.app')

@section('title', $news->title)

@section('content')

    <style>
        :root {
            --primary-red: #E63946;
            --primary-red-dark: #D62828;
            --primary-red-light: #F77F00;
            --accent-red: #FCBF49;
            --dark-bg: #1D3557;
            --text-dark: #14213D;
            --text-gray: #6C757D;
            --bg-light: #F1FAEE;
            --border-light: #DEE2E6;
            --white: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-light);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        /* ==================== DETAIL PAGE WRAPPER ==================== */
        .detail-wrapper {
            background: var(--bg-light);
            padding: 2rem 0 4rem;
        }

        .detail-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* ==================== BREADCRUMB ==================== */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            font-size: 0.9rem;
            color: var(--text-gray);
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: var(--primary-red);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .breadcrumb a:hover {
            color: var(--primary-red-dark);
            text-decoration: underline;
        }

        .breadcrumb-separator {
            color: var(--text-gray);
            font-weight: 600;
        }

        .breadcrumb-current {
            color: var(--text-dark);
            font-weight: 600;
        }

        /* ==================== DETAIL GRID LAYOUT ==================== */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 2.5rem;
        }

        /* ==================== MAIN ARTICLE SECTION ==================== */
        .article-main {
            background: white;
            padding: 3rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            border-top: 6px solid var(--primary-red);
        }

        /* Article Category Badge */
        .article-category-badge {
            display: inline-block;
            background: var(--primary-red);
            color: white;
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(230, 57, 70, 0.3);
        }

        /* Article Title */
        .article-title {
            font-size: 2.75rem;
            font-weight: 900;
            color: var(--text-dark);
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        /* Article Meta Information */
        .article-meta {
            display: flex;
            align-items: center;
            gap: 2rem;
            padding: 1.5rem 0;
            border-top: 3px solid var(--border-light);
            border-bottom: 3px solid var(--border-light);
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }

        .author-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 3px solid var(--primary-red);
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .author-name {
            font-weight: 800;
            color: var(--text-dark);
            font-size: 1rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-gray);
            font-size: 0.9rem;
            font-weight: 600;
        }

        .meta-icon {
            width: 20px;
            height: 20px;
            color: var(--primary-red);
        }

        /* Featured Image */
        .article-featured-image {
            width: 100%;
            max-height: 550px;
            object-fit: cover;
            margin-bottom: 2.5rem;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        /* Article Content */
        .article-content {
            font-size: 1.1rem;
            line-height: 1.9;
            color: var(--text-dark);
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content h2 {
            font-size: 1.9rem;
            font-weight: 900;
            color: var(--text-dark);
            margin-top: 3rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 3px solid var(--primary-red);
        }

        .article-content h3 {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-top: 2.5rem;
            margin-bottom: 1rem;
        }

        .article-content h4 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-top: 2rem;
            margin-bottom: 0.75rem;
        }

        .article-content ul,
        .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .article-content li {
            margin-bottom: 0.75rem;
            line-height: 1.8;
        }

        .article-content blockquote {
            border-left: 5px solid var(--primary-red);
            background: var(--bg-light);
            padding: 1.5rem 2rem;
            margin: 2.5rem 0;
            font-style: italic;
            color: var(--text-gray);
            font-size: 1.15rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .article-content img {
            margin: 2.5rem 0;
            max-width: 100%;
            height: auto;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .article-content a {
            color: var(--primary-red);
            text-decoration: underline;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .article-content a:hover {
            color: var(--primary-red-dark);
        }

        /* Share Section */
        .share-section {
            margin-top: 3rem;
            padding-top: 2.5rem;
            border-top: 3px solid var(--border-light);
        }

        .share-title {
            font-size: 1.2rem;
            font-weight: 900;
            color: var(--text-dark);
            margin-bottom: 1.25rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .share-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .share-btn {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.8rem 1.75rem;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .share-btn-facebook {
            background: #1877F2;
            color: white;
        }

        .share-btn-twitter {
            background: #1DA1F2;
            color: white;
        }

        .share-btn-whatsapp {
            background: #25D366;
            color: white;
        }

        .share-btn-copy {
            background: var(--dark-bg);
            color: white;
        }

        .share-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .share-icon {
            width: 18px;
            height: 18px;
        }

        /* Author Bio Card */
        .author-card {
            background: linear-gradient(135deg, rgba(230, 57, 70, 0.05) 0%, rgba(214, 40, 40, 0.05) 100%);
            padding: 2.5rem;
            margin-top: 3rem;
            border: 3px solid var(--border-light);
            border-left: 6px solid var(--primary-red);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .author-card:hover {
            border-color: var(--primary-red);
            box-shadow: 0 8px 30px rgba(230, 57, 70, 0.15);
        }

        .author-card-title {
            font-size: 1.4rem;
            font-weight: 900;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .author-card-content {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .author-card-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid var(--primary-red);
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .author-card-info {
            flex: 1;
        }

        .author-card-name {
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
        }

        .author-card-bio {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-gray);
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            position: sticky;
            top: 2rem;
            height: fit-content;
        }

        .sidebar-widget {
            background: white;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            border-top: 5px solid var(--primary-red);
        }

        .widget-header {
            background: var(--dark-bg);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .widget-icon {
            width: 38px;
            height: 38px;
            background: var(--primary-red);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .widget-title {
            font-size: 1.15rem;
            font-weight: 900;
            color: white;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .widget-content {
            padding: 1.5rem;
        }

        /* Sidebar Article Card */
        .sidebar-article {
            display: flex;
            gap: 1.25rem;
            padding: 1.25rem 0;
            text-decoration: none;
            color: inherit;
            border-bottom: 2px solid var(--border-light);
            transition: all 0.3s ease;
        }

        .sidebar-article:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .sidebar-article:hover {
            padding-left: 0.5rem;
            border-left: 4px solid var(--primary-red);
        }

        .sidebar-article-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            flex-shrink: 0;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .sidebar-article:hover .sidebar-article-image {
            transform: scale(1.05);
        }

        .sidebar-article-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .sidebar-article-badge {
            background: var(--primary-red);
            color: white;
            padding: 0.3rem 0.8rem;
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            width: fit-content;
            margin-bottom: 0.6rem;
        }

        .sidebar-article-title {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .sidebar-article-time {
            font-size: 0.75rem;
            color: var(--text-gray);
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-weight: 600;
        }

        /* ==================== RESPONSIVE DESIGN ==================== */
        @media (max-width: 1024px) {
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .sidebar {
                position: relative;
                top: 0;
            }

            .article-title {
                font-size: 2.25rem;
            }

            .article-main {
                padding: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .detail-container {
                padding: 0 1.5rem;
            }

            .article-main {
                padding: 2rem 1.5rem;
            }

            .article-title {
                font-size: 1.9rem;
            }

            .article-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .article-content {
                font-size: 1rem;
            }

            .article-content h2 {
                font-size: 1.6rem;
            }

            .article-content h3 {
                font-size: 1.35rem;
            }

            .article-featured-image {
                max-height: 350px;
            }

            .author-card {
                padding: 2rem;
            }

            .author-card-content {
                flex-direction: column;
                text-align: center;
            }

            .author-card-avatar {
                width: 100px;
                height: 100px;
            }

            .share-buttons {
                justify-content: flex-start;
            }

            .widget-content {
                padding: 1.25rem;
            }
        }

        @media (max-width: 640px) {
            .detail-wrapper {
                padding: 1rem 0 3rem;
            }

            .detail-container {
                padding: 0 1rem;
            }

            .article-main {
                padding: 1.5rem 1rem;
            }

            .article-title {
                font-size: 1.6rem;
            }

            .article-featured-image {
                max-height: 280px;
            }

            .breadcrumb {
                font-size: 0.8rem;
                margin-bottom: 1.5rem;
            }

            .author-card {
                padding: 1.5rem;
            }

            .author-card-avatar {
                width: 80px;
                height: 80px;
            }

            .author-card-name {
                font-size: 1.3rem;
            }

            .author-card-bio {
                font-size: 0.9rem;
            }

            .share-btn {
                padding: 0.7rem 1.25rem;
                font-size: 0.8rem;
            }

            .sidebar-article {
                flex-direction: column;
            }

            .sidebar-article-image {
                width: 100%;
                height: 180px;
            }

            .article-content h2 {
                font-size: 1.4rem;
            }

            .article-content h3 {
                font-size: 1.2rem;
            }
        }

        /* ==================== ANIMATIONS ==================== */
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

        /* ==================== UTILITY CLASSES ==================== */
        .text-center {
            text-align: center;
        }

        .mt-2 {
            margin-top: 2rem;
        }
    </style>

    <!-- News Detail Content -->
    <div class="detail-wrapper">
        <div class="detail-container">
            <!-- Breadcrumb -->
            <nav class="breadcrumb fade-in-up">
                <a href="{{ route('landing') }}">Beranda</a>
                <span class="breadcrumb-separator">→</span>
                <a href="{{ route('news.category', $news->category->slug) }}">{{ $news->category->title }}</a>
                <span class="breadcrumb-separator">→</span>
                <span class="breadcrumb-current">{{ Str::limit($news->title, 50) }}</span>
            </nav>

            <!-- Detail Grid -->
            <div class="detail-grid">
                <!-- Main Article -->
                <article class="article-main fade-in-up stagger-1">
                    <!-- Category Badge -->
                    <span class="article-category-badge">{{ $news->category->title }}</span>

                    <!-- Article Title -->
                    <h1 class="article-title">{{ $news->title }}</h1>

                    <!-- Article Meta -->
                    <div class="article-meta">
                        <div class="author-info">
                            <img src="{{ asset('storage/' . $news->author->avatar) }}" alt="{{ $news->author->name }}"
                                class="author-avatar">
                            <div>
                                <div class="author-name">{{ $news->author->name }}</div>
                            </div>
                        </div>

                        <div class="meta-item">
                            <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($news->created_at)->format('d F Y') }}</span>
                        </div>

                        <div class="meta-item">
                            <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($news->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}"
                        class="article-featured-image">

                    <!-- Article Content -->
                    <div class="article-content">
                        {!! $news->content !!}
                    </div>

                    <!-- Share Section -->
                    <div class="share-section">
                        <h3 class="share-title">Bagikan Artikel</h3>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news->slug)) }}"
                                target="_blank" class="share-btn share-btn-facebook">
                                <svg class="share-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                target="_blank" class="share-btn share-btn-twitter">
                                <svg class="share-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                                Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . route('news.show', $news->slug)) }}"
                                target="_blank" class="share-btn share-btn-whatsapp">
                                <svg class="share-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                                WhatsApp
                            </a>
                            <button onclick="copyToClipboard('{{ route('news.show', $news->slug) }}')"
                                class="share-btn share-btn-copy">
                                <svg class="share-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                Salin Link
                            </button>
                        </div>
                    </div>

                    <!-- Author Bio Card -->
                    <div class="author-card">
                        <h3 class="author-card-title">Tentang Penulis</h3>
                        <div class="author-card-content">
                            <img src="{{ asset('storage/' . $news->author->avatar) }}" alt="{{ $news->author->name }}"
                                class="author-card-avatar">
                            <div class="author-card-info">
                                <h4 class="author-card-name">{{ $news->author->name }}</h4>
                                <p class="author-card-bio">{!! $news->author->bio !!}</p>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Sidebar -->
                <aside class="sidebar fade-in-up stagger-2">
                    <!-- Latest News Widget -->
                    <div class="sidebar-widget">
                        <div class="widget-header">
                            <div class="widget-icon">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                </svg>
                            </div>
                            <h3 class="widget-title">Berita Terbaru</h3>
                        </div>

                        <div class="widget-content">
                            @foreach ($sideArticles as $sideArticle)
                                <a href="{{ route('news.show', $sideArticle->slug) }}" class="sidebar-article">
                                    <img src="{{ asset('storage/' . $sideArticle->thumbnail) }}"
                                        alt="{{ $sideArticle->title }}" class="sidebar-article-image">
                                    <div class="sidebar-article-content">
                                        <span class="sidebar-article-badge">{{ $sideArticle->category->title }}</span>
                                        <h4 class="sidebar-article-title">{{ $sideArticle->title }}</h4>
                                        <div class="sidebar-article-time">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                                <path
                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($sideArticle->created_at)->diffForHumans() }}
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Link berhasil disalin ke clipboard!');
            }, function(err) {
                console.error('Gagal menyalin link: ', err);
                alert('Gagal menyalin link. Silakan coba lagi.');
            });
        }
    </script>

@endsection
