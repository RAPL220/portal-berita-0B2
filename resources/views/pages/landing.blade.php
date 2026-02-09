@extends('layouts.app')

@section('title', 'Fokus Kito')

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
            --orange-accent: #FF6B35;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-light);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        /* ==================== HERO SECTION ==================== */
        .hero-wrapper {
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            padding: 3rem 0 4rem;
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
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
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

        .hero-swiper {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .swiper-slide {
            position: relative;
            height: 550px;
            background-size: cover;
            background-position: center;
        }

        .slide-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0) 100%);
        }

        .slide-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 3rem;
            z-index: 10;
        }

        .slide-category {
            display: inline-block;
            background: var(--primary-blue);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .slide-title {
            font-size: 3rem;
            font-weight: 900;
            color: white;
            line-height: 1.15;
            margin-bottom: 1rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            max-width: 900px;
        }

        .slide-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 3px solid white;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .author-name {
            color: white;
            font-size: 0.95rem;
            font-weight: 600;
        }

        /* ==================== TRENDING NEWS SECTION ==================== */
        .trending-section {
            max-width: 1400px;
            margin: -2rem auto 4rem;
            padding: 0 2rem;
            position: relative;
            z-index: 10;
        }

        .trending-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .trending-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
        }

        .trending-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.2);
        }

        .trending-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .trending-card:hover .trending-image {
            transform: scale(1.1);
        }

        .trending-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--primary-blue);
            color: white;
            padding: 0.4rem 0.9rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .trending-content {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .trending-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: auto;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .trending-date {
            color: var(--text-gray);
            font-size: 0.8rem;
            margin-top: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* ==================== MAIN CONTENT SECTION ==================== */
        .main-content {
            max-width: 1400px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2.2fr 1fr;
            gap: 3rem;
        }

        /* Section Header */
        .section-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 3px solid var(--primary-blue);
        }

        .section-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-blue);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 900;
            color: var(--text-dark);
            margin: 0;
        }

        /* Latest News Cards */
        .news-list {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .news-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            gap: 1.5rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            padding: 1.5rem;
        }

        .news-card:hover {
            transform: translateX(8px);
            box-shadow: 0 8px 30px rgba(37, 99, 235, 0.15);
        }

        .news-image {
            width: 280px;
            height: 200px;
            object-fit: cover;
            border-radius: 16px;
            flex-shrink: 0;
            transition: transform 0.5s ease;
        }

        .news-card:hover .news-image {
            transform: scale(1.05);
        }

        .news-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .news-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .news-category {
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .news-time {
            color: var(--text-gray);
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .news-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.3;
            margin-bottom: 0.75rem;
        }

        .news-excerpt {
            font-size: 0.95rem;
            color: var(--text-gray);
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ==================== SIDEBAR ==================== */
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

        .sidebar-item {
            display: flex;
            gap: 1rem;
            padding: 1rem 0;
            text-decoration: none;
            color: inherit;
            border-bottom: 1px solid var(--border-light);
            transition: all 0.3s ease;
        }

        .sidebar-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .sidebar-item:hover {
            transform: translateX(5px);
        }

        .sidebar-image {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 12px;
            flex-shrink: 0;
        }

        .sidebar-content {
            flex: 1;
        }

        .sidebar-item-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .sidebar-time {
            color: var(--text-gray);
            font-size: 0.75rem;
        }

        /* ==================== FEATURED SECTION (In Combined Layout) ==================== */
        .featured-section {
            display: flex;
            flex-direction: column;
        }

        .featured-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .btn-view-all {
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            color: white;
            padding: 0.85rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(11, 122, 189, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-view-all:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(11, 122, 189, 0.4);
            background: linear-gradient(135deg, var(--primary-blue-light) 0%, var(--gradient-blue-start) 100%);
        }

        .featured-grid {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .featured-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            display: flex;
            gap: 1.25rem;
            padding: 1.25rem;
        }

        .featured-card:hover {
            transform: translateX(8px);
            box-shadow: 0 8px 30px rgba(11, 122, 189, 0.15);
        }

        .featured-image-wrapper {
            position: relative;
            overflow: hidden;
            width: 200px;
            height: 160px;
            flex-shrink: 0;
            border-radius: 12px;
        }

        .featured-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .featured-card:hover .featured-image {
            transform: scale(1.1);
        }

        .featured-category {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            background: var(--primary-blue);
            color: white;
            padding: 0.35rem 0.8rem;
            border-radius: 8px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 10;
        }

        .featured-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .featured-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.3;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .featured-excerpt {
            font-size: 0.85rem;
            color: var(--text-gray);
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .featured-date {
            color: var(--text-gray);
            font-size: 0.75rem;
            margin-top: auto;
        }

        /* ==================== POPULAR & FEATURED COMBINED SECTION ==================== */
        .combined-section {
            max-width: 1400px;
            margin: 5rem auto;
            padding: 0 2rem;
        }

        /* .combined-grid {
                                display: grid;
                                grid-template-columns: 1fr 1.2fr;
                                gap: 3rem;
                            } */

        .left-column {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .right-column {
            display: flex;
            flex-direction: column;
        }

        .popular-grid {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .main-popular {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .main-popular:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(11, 122, 189, 0.2);
        }

        .main-popular-image {
            width: 100%;
            height: 350px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .main-popular:hover .main-popular-image {
            transform: scale(1.05);
        }

        .main-popular-content {
            padding: 2rem;
        }

        .main-popular-category {
            background: linear-gradient(135deg, var(--gradient-blue-start) 0%, var(--gradient-blue-end) 100%);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .main-popular-title {
            font-size: 1.75rem;
            font-weight: 900;
            color: var(--text-dark);
            line-height: 1.25;
            margin-bottom: 1rem;
        }

        .main-popular-excerpt {
            font-size: 1rem;
            color: var(--text-gray);
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .side-popular-list {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .side-popular-card {
            background: white;
            border-radius: 16px;
            padding: 1rem;
            display: flex;
            gap: 1rem;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .side-popular-card:hover {
            transform: translateX(8px);
            box-shadow: 0 8px 25px rgba(11, 122, 189, 0.15);
        }

        .side-popular-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            flex-shrink: 0;
        }

        .side-popular-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .side-popular-badge {
            background: var(--primary-blue);
            color: white;
            padding: 0.35rem 0.8rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            width: fit-content;
            margin-bottom: 0.5rem;
        }

        .side-popular-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: 0.35rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .side-popular-excerpt {
            font-size: 0.8rem;
            color: var(--text-gray);
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .side-popular-time {
            font-size: 0.75rem;
            color: var(--text-gray);
            margin-top: 0.25rem;
        }

        /* ==================== RESPONSIVE DESIGN ==================== */
        @media (max-width: 1200px) {
            .trending-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .combined-grid {
                grid-template-columns: 1fr;
            }

            .content-grid {
                grid-template-columns: 1.5fr 1fr;
            }
        }

        @media (max-width: 1024px) {
            .slide-title {
                font-size: 2.25rem;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: relative;
                top: 0;
            }

            .combined-grid {
                grid-template-columns: 1fr;
            }

            .news-card {
                flex-direction: column;
            }

            .news-image {
                width: 100%;
                height: 250px;
            }

            .featured-card {
                flex-direction: row;
            }

            .featured-image-wrapper {
                width: 200px;
                height: 160px;
            }
        }

        @media (max-width: 768px) {
            .hero-wrapper {
                padding: 2rem 0 3rem;
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

            .trending-grid {
                grid-template-columns: 1fr;
            }

            .trending-section {
                margin: -1rem auto 3rem;
            }

            .combined-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .news-title {
                font-size: 1.25rem;
            }

            .main-popular-image {
                height: 300px;
            }

            .main-popular-content {
                padding: 1.5rem;
            }

            .main-popular-title {
                font-size: 1.5rem;
            }

            .featured-card {
                flex-direction: column;
            }

            .featured-image-wrapper {
                width: 100%;
                height: 200px;
            }
        }

        @media (max-width: 640px) {

            .hero-container,
            .trending-section,
            .main-content,
            .combined-section {
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
                gap: 0.5rem;
            }

            .section-title {
                font-size: 1.35rem;
            }

            .news-card {
                padding: 1rem;
            }

            .news-image {
                height: 200px;
            }

            .sidebar-widget {
                padding: 1.5rem;
            }

            .featured-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .side-popular-card {
                flex-direction: column;
            }

            .side-popular-image {
                width: 100%;
                height: 180px;
            }

            .featured-card {
                flex-direction: column;
                padding: 0;
            }

            .featured-image-wrapper {
                width: 100%;
                height: 200px;
                border-radius: 0;
            }

            .featured-content {
                padding: 1.25rem;
            }

            .main-popular-image {
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
            width: 12px;
            height: 12px;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
            background: white;
        }
    </style>

    <!-- Hero Section with Swiper -->
    <div class="hero-wrapper">
        <div class="hero-container">
            <div class="hero-badge">
                Berita Terkini
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

    <!-- Trending News Section -->
    <section class="trending-section">
        <div class="trending-grid">
            @foreach ($news->take(4) as $index => $item)
                <a href="{{ route('news.show', $item->slug) }}"
                    class="trending-card fade-in-up stagger-{{ $index + 1 }}">
                    <div style="position: relative; overflow: hidden;">
                        <span class="trending-badge">{{ $item->category->title }}</span>
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}"
                            class="trending-image">
                    </div>
                    <div class="trending-content">
                        <h3 class="trending-title">{{ $item->title }}</h3>
                        <div class="trending-date">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="main-content">
        <div class="content-grid">
            <!-- Latest News -->
            <div>
                <div class="section-header">

                    <!-- Right Column: Featured News -->
                    <div class="right-column">
                        <div class="featured-section">
                            <div class="featured-header">
                                <div class="section-header" style="margin-bottom: 0; border-bottom: none;">
                                    <div class="section-icon">
                                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                        </svg>
                                    </div>
                                    <h2 class="section-title">Berita Unggulan</h2>
                                </div>
                                <a href="{{ route('news.index') }}" class="btn-view-all">
                                    Lihat Semua
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                    </svg>
                                </a>
                            </div>

                            <div class="featured-grid">
                                @foreach ($featureds as $index => $featured)
                                    <a href="{{ route('news.show', $featured->slug) }}" class="featured-card">
                                        <div class="featured-image-wrapper">
                                            <span class="featured-category">{{ $featured->category->title }}</span>
                                            <img src="{{ asset('storage/' . $featured->thumbnail) }}"
                                                alt="{{ $featured->title }}" class="featured-image">
                                        </div>
                                        <div class="featured-content">
                                            <h3 class="featured-title">{{ $featured->title }}</h3>
                                            <div class="featured-excerpt">{!! $featured->content !!}</div>
                                            <div class="featured-date">
                                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16"
                                                    style="display: inline-block; vertical-align: middle; margin-right: 0.35rem;">
                                                    <path
                                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2z" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($featured->created_at)->format('d F Y') }}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="news-list">
                    @foreach ($news->skip(4) as $item)
                        <a href="{{ route('news.show', $item->slug) }}" class="news-card">
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}"
                                class="news-image">
                            <div class="news-content">
                                <div class="news-meta">
                                    <span class="news-category">{{ $item->category->title }}</span>
                                    <span class="news-time">
                                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                            <path
                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                                <h3 class="news-title">{{ $item->title }}</h3>
                                <div class="news-excerpt">{!! $item->content !!}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>



            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="sidebar-widget">
                    <div class="widget-header">
                        <div class="widget-icon">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                            </svg>
                        </div>
                        <h3 class="widget-title">Bacaan Populer</h3>
                    </div>

                    @foreach ($newsDownList as $side)
                        <a href="{{ route('news.show', $side->slug) }}" class="sidebar-item">
                            <img src="{{ asset('storage/' . $side->thumbnail) }}" alt="{{ $side->title }}"
                                class="sidebar-image">
                            <div class="sidebar-content">
                                <h4 class="sidebar-item-title">{{ $side->title }}</h4>
                                <span
                                    class="sidebar-time">{{ \Carbon\Carbon::parse($side->created_at)->diffForHumans() }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>

    <!-- Combined Popular & Featured Section -->
    <section class="combined-section">
        <div class="combined-grid">
            <!-- Left Column: Popular News -->
            <div class="left-column">
                <div class="section-header">
                    <div class="section-icon">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>
                    </div>
                    <h2 class="section-title">Berita Populer</h2>
                </div>

                <div class="popular-grid">
                    @if (isset($mostViewed[0]))
                        <a href="{{ route('news.show', $mostViewed[0]->slug) }}" class="main-popular">
                            <div style="position: relative; overflow: hidden;">
                                <img src="{{ asset('storage/' . $mostViewed[0]->thumbnail) }}"
                                    alt="{{ $mostViewed[0]->title }}" class="main-popular-image">
                            </div>
                            <div class="main-popular-content">
                                <span class="main-popular-category">{{ $mostViewed[0]->category->title }}</span>
                                <h2 class="main-popular-title">{{ $mostViewed[0]->title }}</h2>
                                <div class="main-popular-excerpt">{!! $mostViewed[0]->content !!}</div>
                                <div class="trending-date">
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($mostViewed[0]->created_at)->format('d F Y') }}
                                </div>
                            </div>
                        </a>
                    @endif

                    <div class="side-popular-list">
                        @foreach ($mostViewed->skip(1)->take(5) as $popular)
                            <a href="{{ route('news.show', $popular->slug) }}" class="side-popular-card">
                                <img src="{{ asset('storage/' . $popular->thumbnail) }}" alt="{{ $popular->title }}"
                                    class="side-popular-image">
                                <div class="side-popular-content">
                                    <span class="side-popular-badge">{{ $popular->category->title }}</span>
                                    <h3 class="side-popular-title">{{ $popular->title }}</h3>
                                    <div class="side-popular-time">
                                        {{ \Carbon\Carbon::parse($popular->created_at)->diffForHumans() }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
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
