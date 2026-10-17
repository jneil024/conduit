<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin overview dashboard with statistics and recent articles.
     */
    public function index(): View
    {
        $totalArticles = Article::count();
        $publishedArticles = Article::where('status', 'published')->count();
        $draftArticles = Article::where('status', 'draft')->count();
        
        $categoriesCount = Article::whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct('category')
            ->count('category');

        $recentArticles = Article::with('author')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalArticles',
            'publishedArticles',
            'draftArticles',
            'categoriesCount',
            'recentArticles'
        ));
    }
}
