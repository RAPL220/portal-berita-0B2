@extends('layouts.app')

@section('title', $news->title)

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

        /* Detail Page Container */
        .detail-wrapper {
            background: var(--bg-light);
            padding: 2rem 0 4rem;
        }

        .detail-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            font-size: 0.9rem;
            color: var(--text-gray);
        }

        .breadcrumb a {
            color: var(--primary-blue);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: var(--primary-blue-dark);
        }

        .breadcrumb-separator {
            color: var(--text-gray);
        }

        /* Detail Grid Layout */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 3rem;
        }

        /* Main Article Section */
        .article-main {
            background: white;
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        /* Article Header */
        .article-category-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1.5rem;
        }

        .article-title {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--text-dark);
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        /* Article Meta */
        .article-meta {
            display: flex;
            align-items: center;
            gap: 2rem;
            padding: 1.5rem 0;
            border-top: 2px solid var(--border-light);
            border-bottom: 2px solid var(--border-light);
            margin-bottom: 2rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-gray);
            font-size: 0.9rem;
        }

        .meta-icon {
            width: 18px;
            height: 18px;
            color: var(--primary-blue);
        }

        .author-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary-blue);
            object-fit: cover;
        }

        .author-name {
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Featured Image */
        .article-featured-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        /* Article Content */
        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-dark);
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content h2 {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-top: 2.5rem;
            margin-bottom: 1rem;
        }

        .article-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .article-content ul,
        .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .article-content li {
            margin-bottom: 0.75rem;
        }

        .article-content blockquote {
            border-left: 4px solid var(--primary-blue);
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: var(--text-gray);
        }

        .article-content img {
            border-radius: 12px;
            margin: 2rem 0;
            max-width: 100%;
            height: auto;
        }

        /* Share Buttons */
        .share-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid var(--border-light);
        }

        .share-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .share-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .share-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
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
            background: var(--border-light);
            color: var(--text-dark);
        }

        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .share-icon {
            width: 18px;
            height: 18px;
        }

        /* Author Bio Card */
        .author-card {
            background: linear-gradient(135deg, rgba(14, 134, 201, 0.05) 0%, rgba(11, 95, 150, 0.05) 100%);
            border-radius: 20px;
            padding: 2rem;
            margin-top: 3rem;
            border: 2px solid var(--border-light);
            transition: all 0.3s ease;
        }

        .author-card:hover {
            border-color: var(--primary-blue);
            box-shadow: 0 8px 30px rgba(11, 122, 189, 0.15);
        }

        .author-card-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }

        .author-card-content {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .author-card-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid var(--primary-blue);
            object-fit: cover;
            flex-shrink: 0;
        }

        .author-card-info {
            flex: 1;
        }

        .author-card-name {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .author-card-bio {
            font-size: 0.95rem;
            line-height: 1.6;
            color: var(--text-gray);
        }

        /* Sidebar */
        .sidebar {
            position: sticky;
            top: 2rem;
            height: fit-content;
        }

        .sidebar-widget {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            margin-bottom: 2rem;
        }

        .widget-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-light);
        }

        .widget-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .widget-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-dark);
            margin: 0;
        }

        /* Sidebar Article Card */
        .sidebar-article {
            display: flex;
            gap: 1rem;
            padding: 1rem 0;
            text-decoration: none;
            color: inherit;
            border-bottom: 1px solid var(--border-light);
            transition: all 0.3s ease;
        }

        .sidebar-article:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .sidebar-article:hover {
            transform: translateX(5px);
        }

        .sidebar-article-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            flex-shrink: 0;
            transition: transform 0.3s ease;
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
            background: var(--primary-blue);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            width: fit-content;
            margin-bottom: 0.5rem;
        }

        .sidebar-article-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .sidebar-article-excerpt {
            font-size: 0.8rem;
            color: var(--text-gray);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-top: auto;
        }

        .sidebar-article-time {
            font-size: 0.75rem;
            color: var(--text-gray);
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        /* Responsive Design */
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
                font-size: 2rem;
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
                font-size: 1.75rem;
            }

            .article-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .article-content {
                font-size: 1rem;
            }

            .author-card-content {
                flex-direction: column;
                text-align: center;
            }

            .share-buttons {
                justify-content: center;
            }

            .sidebar-widget {
                padding: 1.5rem;
            }

            .sidebar-article {
                flex-direction: column;
            }

            .sidebar-article-image {
                width: 100%;
                height: 180px;
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
                border-radius: 16px;
            }

            .article-title {
                font-size: 1.5rem;
            }

            .article-featured-image {
                max-height: 300px;
            }

            .breadcrumb {
                font-size: 0.8rem;
            }

            .author-card {
                padding: 1.5rem;
            }

            .author-card-avatar {
                width: 80px;
                height: 80px;
            }

            .author-card-name {
                font-size: 1.25rem;
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
    </style>

    <!-- News Detail Content -->
    <div class="detail-wrapper">
        <div class="detail-container">
            <!-- Breadcrumb -->
            <nav class="breadcrumb fade-in-up">
                <a href="{{ route('landing') }}">Beranda</a>
                <span class="breadcrumb-separator">/</span>
                <a href="{{ route('news.category', $news->category->slug) }}">{{ $news->category->title }}</a>
                <span class="breadcrumb-separator">/</span>
                <span>{{ Str::limit($news->title, 50) }}</span>
            </nav>

            <!-- Detail Grid -->
            <div class="detail-grid">
                <!-- Main Article -->
                <article class="article-main fade-in-up">
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
                <aside class="sidebar fade-in-up">
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

                        @foreach ($sideArticles as $sideArticle)
                            <a href="{{ route('news.show', $sideArticle->slug) }}" class="sidebar-article">
                                <img src="{{ asset('storage/' . $sideArticle->thumbnail) }}"
                                    alt="{{ $sideArticle->title }}" class="sidebar-article-image">
                                <div class="sidebar-article-content">
                                    <span class="sidebar-article-badge">{{ $sideArticle->category->title }}</span>
                                    <h4 class="sidebar-article-title">{{ $sideArticle->title }}</h4>
                                    <div class="sidebar-article-excerpt">{!! $sideArticle->content !!}</div>
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
                </aside>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Link berhasil disalin!');
            }, function(err) {
                console.error('Gagal menyalin link: ', err);
            });
        }
    </script>

@endsection
