<?php

namespace App\Http\Controllers;

use App\Models\ArticlesNews;
use App\Models\Categories;
use Illuminate\Http\Request;


class NewsController extends Controller
{

    public function index(Request $request)
    {
        // codingan di bawah ini advance search
        $search = $request->input('search');
        // $news = ArticlesNews::paginate(10);
        $news = ArticlesNews::query()->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")->orWhere('content', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // codingan basic search di bawah ini
        //     $news = ArticlesNews::query()
        // ->when($search, function ($query, $search) {
        //     $query->where(function ($q) use ($search) {
        //         $q->where('title', 'like', '%' . $search . '%')
        //           ->orWhere('content', 'like', '%' . $search . '%');
        //     });
        // })
        // ->orderBy('created_at', 'desc')
        // ->paginate(10)
        // ->withQueryString();


        return view('pages.news.index', compact('news'));
    }


    public function show($slug)
    {
        $news = ArticlesNews::where('slug', $slug)->first();
        $news->increment('views');
        $sideArticles = ArticlesNews::orderBy('created_at', 'desc')->get()->take(4);
        return view('pages.news.show', compact('news', 'sideArticles'));
    }


    public function category($slug)
    {
        $category = Categories::where('slug', $slug)->first();
        return view('pages.news.category', compact('category'));
    }
}
