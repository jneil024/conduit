<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the public front page.
     */
    public function index(): View
    {
        $featuredArticles = Article::published()
            ->with('author')
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('home', compact('featuredArticles'));
    }
}
