@extends('layouts.app')

@section('title', 'Semua Berita')

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

        /* All News Header */
        .all-news-header-wrapper {
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            padding: 4rem 0 5rem;
            position: relative;
            overflow: hidden;
        }

        .all-news-header-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .all-news-header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .header-badge {
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

        .header-icon {
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

        .header-title {
            font-size: 3.5rem;
            font-weight: 900;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .header-description {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 700px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        /* Search Bar in Header */
        .header-search-wrapper {
            max-width: 600px;
            margin: 0 auto;
        }

        .header-search-box {
            position: relative;
            display: flex;
            align-items: center;
            background: white;
            border-radius: 50px;
            padding: 0.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .search-icon-header {
            position: absolute;
            left: 1.5rem;
            width: 22px;
            height: 22px;
            color: var(--text-gray);
            pointer-events: none;
        }

        .header-search-input {
            flex: 1;
            padding: 0.85rem 1.5rem 0.85rem 3.5rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            color: var(--text-dark);
            outline: none;
        }

        .header-search-input::placeholder {
            color: var(--text-gray);
        }

        .header-search-btn {
            padding: 0.85rem 2rem;
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-search-btn:hover {
            transform: translateX(2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Content Wrapper */
        .all-news-content {
            max-width: 1400px;
            margin: -3rem auto 4rem;
            padding: 0 2rem;
            position: relative;
            z-index: 10;
        }

        /* Filter & Control Panel */
        .control-panel {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .control-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            margin-bottom: 1.5rem;
        }

        .control-row:last-child {
            margin-bottom: 0;
        }

        /* Category Filter Pills */
        .category-filter {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            flex: 1;
        }

        .filter-label {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 0.95rem;
            white-space: nowrap;
        }

        .category-pills {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            flex: 1;
        }

        .category-pill {
            padding: 0.6rem 1.25rem;
            border-radius: 50px;
            border: 2px solid var(--border-light);
            background: white;
            color: var(--text-gray);
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .category-pill:hover {
            border-color: var(--primary-blue);
            color: var(--primary-blue);
            background: rgba(11, 122, 189, 0.05);
            transform: translateY(-2px);
        }

        .category-pill.active {
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            border-color: transparent;
            color: white;
            box-shadow: 0 4px 15px rgba(11, 122, 189, 0.3);
        }

        /* Sort & View Controls */
        .sort-view-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sort-dropdown {
            position: relative;
        }

        .sort-select {
            padding: 0.7rem 2.5rem 0.7rem 1.25rem;
            border: 2px solid var(--border-light);
            border-radius: 12px;
            background: white;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            appearance: none;
            transition: all 0.3s ease;
        }

        .sort-select:hover {
            border-color: var(--primary-blue);
        }

        .sort-select:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(11, 122, 189, 0.1);
        }

        .sort-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: var(--text-gray);
            pointer-events: none;
        }

        .view-toggle {
            display: flex;
            gap: 0.5rem;
        }

        .view-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
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
            background: rgba(11, 122, 189, 0.05);
        }

        .view-btn.active {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
            color: white;
        }

        /* Results Info */
        .results-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 2px solid var(--border-light);
        }

        .results-text {
            font-size: 0.95rem;
            color: var(--text-gray);
        }

        .results-count {
            font-weight: 700;
            color: var(--primary-blue);
        }

        /* News Grid */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-bottom: 3rem;
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
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 10;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
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

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 50px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .pagination-link {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid transparent;
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .pagination-link:hover {
            background: rgba(11, 122, 189, 0.08);
            color: var(--primary-blue);
        }

        .pagination-link.active {
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(11, 122, 189, 0.3);
        }

        .pagination-link.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }

        .pagination-dots {
            color: var(--text-gray);
            padding: 0 0.5rem;
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
            .all-news-header-wrapper {
                padding: 3.5rem 0 4.5rem;
            }

            .header-title {
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

            .control-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .category-filter {
                width: 100%;
            }

            .sort-view-controls {
                width: 100%;
                justify-content: space-between;
            }
        }

        @media (max-width: 768px) {
            .all-news-header-wrapper {
                padding: 3rem 0 4rem;
            }

            .all-news-header-container {
                padding: 0 1.5rem;
            }

            .header-icon {
                width: 60px;
                height: 60px;
                font-size: 2rem;
            }

            .header-title {
                font-size: 2rem;
            }

            .header-description {
                font-size: 1rem;
            }

            .all-news-content {
                padding: 0 1.5rem;
                margin-top: -2rem;
            }

            .news-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .control-panel {
                padding: 1.5rem;
            }

            .category-filter {
                flex-direction: column;
                align-items: flex-start;
            }

            .category-pills {
                width: 100%;
            }

            .results-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }

        @media (max-width: 640px) {
            .all-news-header-container {
                padding: 0 1rem;
            }

            .header-title {
                font-size: 1.75rem;
            }

            .header-description {
                font-size: 0.95rem;
            }

            .header-search-btn {
                padding: 0.85rem 1.5rem;
            }

            .all-news-content {
                padding: 0 1rem;
            }

            .control-panel {
                padding: 1rem;
            }

            .news-card-content {
                padding: 1.25rem;
            }

            .sort-view-controls {
                flex-direction: column;
                width: 100%;
            }

            .sort-dropdown {
                width: 100%;
            }

            .sort-select {
                width: 100%;
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

    <!-- All News Header -->
    <div class="all-news-header-wrapper">
        <div class="all-news-header-container">
            <!-- Header Badge -->
            <div class="header-badge fade-in-up">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
                Eksplorasi Berita
            </div>

            <!-- Header Icon -->
            <div class="header-icon fade-in-up">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="50" height="50">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>

            <!-- Header Title -->
            <h1 class="header-title fade-in-up">Semua Berita</h1>

            <!-- Header Description -->
            <p class="header-description fade-in-up">
                Temukan berita terkini dan terpercaya dari berbagai kategori.
                Selalu update dengan informasi terbaru seputar Palembang dan Sumatera Selatan.
            </p>

            <!-- Search Bar -->
            <div class="header-search-wrapper fade-in-up">
                <form action="{{ route('news.index') }}" method="GET" class="header-search-box">
                    <svg class="search-icon-header" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" class="header-search-input"
                        placeholder="Cari berita, topik, atau kategori..." value="{{ request('search') }}">
                    <button type="submit" class="header-search-btn">
                        <span>Cari</span>
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- All News Content -->
    <div class="all-news-content">
        <!-- Control Panel -->
        <div class="control-panel fade-in-up">
            <!-- Category Filter Row -->
            <div class="control-row">
                <div class="category-filter">
                    <span class="filter-label">Kategori:</span>
                    <div class="category-pills">
                        <a href="{{ route('news.index') }}"
                            class="category-pill {{ !request('category') ? 'active' : '' }}">
                            Semua
                        </a>
                        @foreach (\App\Models\Categories::all() as $cat)
                            <a href="{{ route('news.index', ['category' => $cat->slug]) }}"
                                class="category-pill {{ request('category') == $cat->slug ? 'active' : '' }}">
                                {{ $cat->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Sort & View Row -->
            <div class="control-row">
                <div class="results-info">
                    <span class="results-text">
                        Menampilkan <span class="results-count">{{ $news->total() }}</span> artikel
                        @if (request('search'))
                            untuk pencarian "<strong>{{ request('search') }}</strong>"
                        @endif
                    </span>
                </div>

                <div class="sort-view-controls">
                    <!-- Sort Dropdown -->
                    <div class="sort-dropdown">
                        <select class="sort-select" onchange="sortNews(this.value)">
                            <option value="latest" {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>
                                Terbaru
                            </option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>
                                Terpopuler
                            </option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                Terlama
                            </option>
                        </select>
                        <svg class="sort-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <!-- View Toggle -->
                    <div class="view-toggle">
                        <button class="view-btn active" onclick="toggleView('grid')" title="Tampilan Grid">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </button>
                        <button class="view-btn" onclick="toggleView('list')" title="Tampilan List">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- News Grid -->
        @if ($news->count() > 0)
            <div class="news-grid" id="newsGrid">
                @foreach ($news as $index => $item)
                    <a href="{{ route('news.show', $item->slug) }}"
                        class="news-card fade-in-up stagger-{{ ($index % 6) + 1 }}">
                        <div class="news-card-image-wrapper">
                            <span class="news-card-badge">{{ $item->category->title }}</span>
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}"
                                class="news-card-image">
                        </div>
                        <div class="news-card-content">
                            <h3 class="news-card-title">{{ $item->title }}</h3>
                            <div class="news-card-excerpt">{!! Str::limit(strip_tags($item->content), 150) !!}</div>
                            <div class="news-card-meta">
                                <div class="news-card-author">
                                    <img src="{{ asset('storage/' . $item->author->avatar) }}"
                                        alt="{{ $item->author->name }}" class="author-avatar-small">
                                    <span class="author-name-small">{{ $item->author->name }}</span>
                                </div>
                                <div class="news-card-date">
                                    <svg class="date-icon" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper fade-in-up">
                {{ $news->links('vendor.pagination.custom') }}
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state fade-in-up">
                <div class="empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="60" height="60">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h2 class="empty-title">Tidak Ada Hasil Ditemukan</h2>
                <p class="empty-description">
                    Maaf, kami tidak menemukan berita yang sesuai dengan pencarian Anda.
                    Coba kata kunci lain atau jelajahi kategori yang tersedia.
                </p>
                <a href="{{ route('news.index') }}" class="empty-btn">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset Pencarian
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
            const url = new URL(window.location.href);
            url.searchParams.set('sort', sortType);
            window.location.href = url.toString();
        }

        // Smooth scroll animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('scroll')) {
                document.querySelector('.all-news-content').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    </script>

@endsection
