<?php

namespace App\Http\Controllers;

use App\Models\ArticlesNews;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $articleBanners = ArticlesNews::all();
        $featureds = ArticlesNews::where('is_featured', true)->get();
        // ambil yang terbaru limit 4
        $news = ArticlesNews::orderBy('created_at', 'desc')->get()->take(4);
        $newsDownList = ArticlesNews::orderBy('created_at', 'desc')
            ->skip(4)
            ->take(6)
            ->get();

        // 4 terbanyak views
        $mostViewed = ArticlesNews::orderBy('views', 'desc')
            ->limit(4)
            ->get();
        return view('pages.landing', compact('articleBanners', 'featureds', 'news', 'newsDownList', 'mostViewed'));
    }
}
