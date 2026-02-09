@extends('layouts.app')

@section('title', 'Fokus Kito')

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

        /* ==================== HERO SECTION ==================== */
        .hero-wrapper {
            background: var(--dark-bg);
            padding: 2rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--primary-red-dark) 100%);
            opacity: 0.9;
        }

        .hero-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--white);
            color: var(--primary-red);
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .hero-swiper {
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .swiper-slide {
            position: relative;
            height: 500px;
            background-size: cover;
            background-position: center;
        }

        .slide-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.3) 60%, transparent 100%);
        }

        .slide-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2.5rem;
            z-index: 10;
        }

        .slide-category {
            display: inline-block;
            background: var(--primary-red);
            color: white;
            padding: 0.4rem 1.2rem;
            font-size: 0.7rem;
            font-weight: 900;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .slide-title {
            font-size: 2.5rem;
            font-weight: 900;
            color: white;
            line-height: 1.2;
            margin-bottom: 1rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.7);
            max-width: 800px;
        }

        .slide-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .author-avatar {
            width: 38px;
            height: 38px;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        .author-name {
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* ==================== GRID CARDS SECTION ==================== */
        .grid-cards-section {
            max-width: 1400px;
            margin: -3rem auto 4rem;
            padding: 0 2rem;
            position: relative;
            z-index: 10;
        }

        .grid-cards-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .grid-card {
            background: white;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            border-top: 4px solid var(--primary-red);
        }

        .grid-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(230, 57, 70, 0.3);
        }

        .grid-card-image-wrapper {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .grid-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .grid-card:hover .grid-card-image {
            transform: scale(1.15);
        }

        .grid-card-badge {
            position: absolute;
            top: 0;
            left: 0;
            background: var(--primary-red);
            color: white;
            padding: 0.4rem 1rem;
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .grid-card-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .grid-card-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: auto;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .grid-card-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px solid var(--border-light);
            font-size: 0.75rem;
            color: var(--text-gray);
        }

        /* ==================== MAIN LAYOUT ==================== */
        .main-layout {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .layout-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 4rem;
        }

        /* Section Header */
        .section-header {
            background: white;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-left: 5px solid var(--primary-red);
        }

        .section-title-wrapper {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-number {
            width: 40px;
            height: 40px;
            background: var(--primary-red);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 900;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--text-dark);
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-view-all {
            background: var(--primary-red);
            color: white;
            padding: 0.6rem 1.5rem;
            text-decoration: none;
            font-weight: 800;
            font-size: 0.75rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 2px solid var(--primary-red);
        }

        .btn-view-all:hover {
            background: transparent;
            color: var(--primary-red);
        }

        /* ==================== NEWS LIST ==================== */
        .news-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .news-box {
            background: white;
            display: flex;
            gap: 1.5rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border-left: 5px solid transparent;
        }

        .news-box:hover {
            box-shadow: 0 8px 30px rgba(230, 57, 70, 0.25);
            border-left-color: var(--primary-red);
            transform: translateX(5px);
        }

        .news-box-image-wrapper {
            position: relative;
            width: 280px;
            height: 200px;
            flex-shrink: 0;
            overflow: hidden;
        }

        .news-box-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .news-box:hover .news-box-image {
            transform: scale(1.1);
        }

        .news-box-content {
            flex: 1;
            padding: 1.5rem 1.5rem 1.5rem 0;
            display: flex;
            flex-direction: column;
        }

        .news-box-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .news-box-category {
            background: var(--primary-red);
            color: white;
            padding: 0.3rem 0.9rem;
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .news-box-time {
            color: var(--text-gray);
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .news-box-title {
            font-size: 1.4rem;
            font-weight: 900;
            color: var(--text-dark);
            line-height: 1.3;
            margin-bottom: 0.75rem;
        }

        .news-box-excerpt {
            font-size: 0.9rem;
            color: var(--text-gray);
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar-container {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .sidebar-box {
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .sidebar-box-header {
            background: var(--dark-bg);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-box-icon {
            width: 32px;
            height: 32px;
            background: var(--primary-red);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .sidebar-box-title {
            font-size: 1.1rem;
            font-weight: 900;
            color: white;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-box-content {
            padding: 1.5rem;
        }

        .sidebar-item {
            display: flex;
            gap: 1rem;
            padding: 1rem 0;
            text-decoration: none;
            color: inherit;
            border-bottom: 2px solid var(--border-light);
            transition: all 0.3s ease;
        }

        .sidebar-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .sidebar-item:hover {
            padding-left: 0.5rem;
        }

        .sidebar-item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .sidebar-item-content {
            flex: 1;
        }

        .sidebar-item-title {
            font-size: 0.9rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .sidebar-item-time {
            color: var(--text-gray);
            font-size: 0.7rem;
            font-weight: 600;
        }

        /* ==================== POPULAR SECTION ==================== */
        .popular-section {
            max-width: 1400px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .popular-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 2rem;
        }

        .popular-main-box {
            background: white;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-top: 6px solid var(--primary-red);
        }

        .popular-main-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(230, 57, 70, 0.25);
        }

        .popular-main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .popular-main-box:hover .popular-main-image {
            transform: scale(1.05);
        }

        .popular-main-content {
            padding: 2rem;
        }

        .popular-main-category {
            background: var(--primary-red);
            color: white;
            padding: 0.4rem 1.2rem;
            font-size: 0.7rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .popular-main-title {
            font-size: 1.75rem;
            font-weight: 900;
            color: var(--text-dark);
            line-height: 1.25;
            margin-bottom: 1rem;
        }

        .popular-main-excerpt {
            font-size: 1rem;
            color: var(--text-gray);
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .popular-side-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .popular-side-box {
            background: white;
            padding: 1.25rem;
            display: flex;
            gap: 1.25rem;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .popular-side-box:hover {
            box-shadow: 0 8px 25px rgba(230, 57, 70, 0.25);
            border-left-color: var(--primary-red);
            transform: translateX(5px);
        }

        .popular-side-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .popular-side-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .popular-side-badge {
            background: var(--dark-bg);
            color: white;
            padding: 0.3rem 0.8rem;
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            width: fit-content;
            margin-bottom: 0.5rem;
        }

        .popular-side-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: 0.5rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .popular-side-time {
            font-size: 0.75rem;
            color: var(--text-gray);
            margin-top: auto;
            font-weight: 600;
        }

        /* ==================== RESPONSIVE DESIGN ==================== */
        @media (max-width: 1200px) {
            .grid-cards-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .layout-grid {
                grid-template-columns: 1fr;
            }

            .popular-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .hero-wrapper {
                padding: 1.5rem 0;
            }

            .swiper-slide {
                height: 400px;
            }

            .slide-content {
                padding: 2rem;
            }

            .slide-title {
                font-size: 1.75rem;
            }

            .grid-cards-container {
                grid-template-columns: 1fr;
            }

            .grid-cards-section {
                margin: -2rem auto 3rem;
            }

            .section-title {
                font-size: 1.2rem;
            }

            .news-box {
                flex-direction: column;
            }

            .news-box-image-wrapper {
                width: 100%;
                height: 220px;
            }

            .news-box-content {
                padding: 1.5rem;
            }

            .news-box-title {
                font-size: 1.2rem;
            }

            .popular-main-image {
                height: 300px;
            }

            .popular-main-content {
                padding: 1.5rem;
            }

            .popular-main-title {
                font-size: 1.4rem;
            }

            .popular-side-box {
                flex-direction: column;
            }

            .popular-side-image {
                width: 100%;
                height: 180px;
            }
        }

        @media (max-width: 640px) {

            .hero-container,
            .grid-cards-section,
            .main-layout,
            .popular-section {
                padding: 0 1rem;
            }

            .swiper-slide {
                height: 350px;
            }

            .slide-title {
                font-size: 1.5rem;
            }

            .slide-content {
                padding: 1.5rem;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .section-title {
                font-size: 1.1rem;
            }

            .news-box {
                padding: 0;
            }

            .sidebar-box-content {
                padding: 1rem;
            }

            .popular-main-image {
                height: 250px;
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

        .stagger-3 {
            animation-delay: 0.3s;
        }

        .stagger-4 {
            animation-delay: 0.4s;
        }

        /* Swiper Custom Styles */
        .swiper-pagination-bullet {
            background: white;
            opacity: 0.5;
            width: 10px;
            height: 10px;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
            background: var(--primary-red);
            width: 30px;
        }
    </style>

    <!-- Hero Section with Swiper -->
    <div class="hero-wrapper">
        <div class="hero-container">
            <div class="hero-badge">
                ⚡ BERITA TERKINI
            </div>
            <div class="swiper hero-swiper">
                <div class="swiper-wrapper">
                    @foreach ($articleBanners as $articleBanner)
                        <div class="swiper-slide"
                            style="background-image: url('{{ asset('storage/' . $articleBanner->thumbnail) }}')">
                            <div class="slide-overlay"></div>
                            <a href="{{ route('news.show', $articleBanner->slug) }}" class="slide-content">
                                <span class="slide-category">{{ $articleBanner->category->title }}</span>
                                <h1 class="slide-title">{{ $articleBanner->title }}</h1>
                                <div class="slide-author">
                                    <img src="{{ asset('storage/' . $articleBanner->author->avatar) }}"
                                        alt="{{ $articleBanner->author->name }}" class="author-avatar">
                                    <span class="author-name">{{ $articleBanner->author->name }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <!-- Grid Cards Section (Top 4 News) -->
    <section class="grid-cards-section">
        <div class="grid-cards-container">
            @foreach ($news->take(4) as $index => $item)
                <a href="{{ route('news.show', $item->slug) }}" class="grid-card fade-in-up stagger-{{ $index + 1 }}">
                    <div class="grid-card-image-wrapper">
                        <span class="grid-card-badge">{{ $item->category->title }}</span>
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}"
                            class="grid-card-image">
                    </div>
                    <div class="grid-card-content">
                        <h3 class="grid-card-title">{{ $item->title }}</h3>
                        <div class="grid-card-meta">
                            <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Main Layout Section -->
    <section class="main-layout">
        <div class="layout-grid">
            <!-- Latest News -->
            <div>
                <div class="section-header">
                    <div class="section-title-wrapper">
                        <div class="section-number">01</div>
                        <h2 class="section-title">Berita Terbaru</h2>
                    </div>
                </div>

                <div class="news-container">
                    @foreach ($news->skip(4)->take(6) as $item)
                        <a href="{{ route('news.show', $item->slug) }}" class="news-box">
                            <div class="news-box-image-wrapper">
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}"
                                    class="news-box-image">
                            </div>
                            <div class="news-box-content">
                                <div class="news-box-meta">
                                    <span class="news-box-category">{{ $item->category->title }}</span>
                                    <span class="news-box-time">
                                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                            <path
                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                                <h3 class="news-box-title">{{ $item->title }}</h3>
                                <div class="news-box-excerpt">{!! $item->content !!}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="sidebar-container">
                <!-- Featured News Widget -->
                <div class="sidebar-box">
                    <div class="sidebar-box-header">
                        <div class="sidebar-box-icon">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </div>
                        <h3 class="sidebar-box-title">Unggulan</h3>
                    </div>

                    <div class="sidebar-box-content">
                        @foreach ($featureds as $featured)
                            <a href="{{ route('news.show', $featured->slug) }}" class="sidebar-item">
                                <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt="{{ $featured->title }}"
                                    class="sidebar-item-image">
                                <div class="sidebar-item-content">
                                    <h4 class="sidebar-item-title">{{ $featured->title }}</h4>
                                    <span
                                        class="sidebar-item-time">{{ \Carbon\Carbon::parse($featured->created_at)->format('d M Y') }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Popular Reading Widget -->
                <div class="sidebar-box">
                    <div class="sidebar-box-header">
                        <div class="sidebar-box-icon">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                            </svg>
                        </div>
                        <h3 class="sidebar-box-title">Terpopuler</h3>
                    </div>

                    <div class="sidebar-box-content">
                        @foreach ($newsDownList as $side)
                            <a href="{{ route('news.show', $side->slug) }}" class="sidebar-item">
                                <img src="{{ asset('storage/' . $side->thumbnail) }}" alt="{{ $side->title }}"
                                    class="sidebar-item-image">
                                <div class="sidebar-item-content">
                                    <h4 class="sidebar-item-title">{{ $side->title }}</h4>
                                    <span
                                        class="sidebar-item-time">{{ \Carbon\Carbon::parse($side->created_at)->diffForHumans() }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <!-- Popular News Section -->
    <section class="popular-section">
        <div class="section-header">
            <div class="section-title-wrapper">
                <div class="section-number">02</div>
                <h2 class="section-title">Berita Populer</h2>
            </div>
            <a href="{{ route('news.index') }}" class="btn-view-all">
                Lihat Semua →
            </a>
        </div>

        <div class="popular-grid">
            <!-- Main Popular Card -->
            @if (isset($mostViewed[0]))
                <a href="{{ route('news.show', $mostViewed[0]->slug) }}" class="popular-main-box">
                    <div style="position: relative; overflow: hidden;">
                        <img src="{{ asset('storage/' . $mostViewed[0]->thumbnail) }}" alt="{{ $mostViewed[0]->title }}"
                            class="popular-main-image">
                    </div>
                    <div class="popular-main-content">
                        <span class="popular-main-category">{{ $mostViewed[0]->category->title }}</span>
                        <h2 class="popular-main-title">{{ $mostViewed[0]->title }}</h2>
                        <div class="popular-main-excerpt">{!! $mostViewed[0]->content !!}</div>
                        <div class="news-box-time">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($mostViewed[0]->created_at)->format('d F Y') }}
                        </div>
                    </div>
                </a>
            @endif

            <!-- Side Popular List -->
            <div class="popular-side-container">
                @foreach ($mostViewed->skip(1)->take(4) as $popular)
                    <a href="{{ route('news.show', $popular->slug) }}" class="popular-side-box">
                        <img src="{{ asset('storage/' . $popular->thumbnail) }}" alt="{{ $popular->title }}"
                            class="popular-side-image">
                        <div class="popular-side-content">
                            <span class="popular-side-badge">{{ $popular->category->title }}</span>
                            <h3 class="popular-side-title">{{ $popular->title }}</h3>
                            <div class="popular-side-time">
                                {{ \Carbon\Carbon::parse($popular->created_at)->diffForHumans() }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.hero-swiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
        });
    </script>

@endsection
