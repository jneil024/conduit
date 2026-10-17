<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of published articles with search and category filters.
     */
    public function index(Request $request): View
    {
        $query = Article::published()->with('author');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $articles = $query->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        $categories = Article::published()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category')
            ->sort();

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * Display the specified published article.
     */
    public function show(string $slug): View
    {
        $article = Article::published()
            ->with('author')
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedArticles = Article::published()
            ->with('author')
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
