<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles with search and filtering for administrators.
     */
    public function index(Request $request): View
    {
        $query = Article::with('author');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $articles = $query->latest()->paginate(10)->withQueryString();

        $categories = Article::whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category')
            ->sort();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create(): View
    {
        $article = new Article([
            'status' => 'draft',
        ]);

        return view('admin.articles.create', compact('article'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(ArticleRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $data['user_id'] = $request->user()->id;

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully.');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article): View
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image && ! str_starts_with($article->featured_image, 'http')) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        if ($data['status'] === 'published' && empty($data['published_at']) && empty($article->published_at)) {
            $data['published_at'] = now();
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    /**
     * Soft delete the specified article from storage.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article moved to trash successfully.');
    }
}
