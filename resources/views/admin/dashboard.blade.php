@extends('layouts.admin')

@section('title', 'Editorial Dashboard')
@section('header', 'Editorial Dashboard')

@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-wider font-semibold text-gray-500">Total Articles</p>
                <h3 class="font-display font-extrabold text-3xl text-conduit-deep mt-1">{{ $totalArticles }}</h3>
            </div>
            <div class="w-12 h-12 rounded-lg bg-conduit-deep/10 text-conduit-deep flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-wider font-semibold text-gray-500">Published</p>
                <h3 class="font-display font-extrabold text-3xl text-conduit-emerald mt-1">{{ $publishedArticles }}</h3>
            </div>
            <div class="w-12 h-12 rounded-lg bg-emerald-50 text-conduit-emerald flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-wider font-semibold text-gray-500">Drafts</p>
                <h3 class="font-display font-extrabold text-3xl text-amber-600 mt-1">{{ $draftArticles }}</h3>
            </div>
            <div class="w-12 h-12 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-wider font-semibold text-gray-500">Categories</p>
                <h3 class="font-display font-extrabold text-3xl text-conduit-gold mt-1">{{ $categoriesCount }}</h3>
            </div>
            <div class="w-12 h-12 rounded-lg bg-amber-50/60 text-conduit-gold flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h3 class="font-display font-bold text-lg text-conduit-deep">Recent Dispatches</h3>
                <p class="text-xs text-gray-500">Latest publications and drafts awaiting review.</p>
            </div>
            <a href="{{ route('admin.articles.index') }}" class="text-xs font-semibold text-conduit-emerald hover:text-conduit-deep transition">
                View All Articles &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 font-semibold text-xs uppercase tracking-wider border-b border-gray-200">
                        <th class="py-3.5 px-6">Article</th>
                        <th class="py-3.5 px-6">Category</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6">Author</th>
                        <th class="py-3.5 px-6">Date</th>
                        <th class="py-3.5 px-6 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentArticles as $article)
                        <tr class="hover:bg-gray-50/70 transition">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200">
                                    <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                </div>
                                <div class="max-w-xs truncate">
                                    <span class="font-semibold text-conduit-deep block truncate">{{ $article->title }}</span>
                                    <span class="text-xs text-gray-400 font-mono">/{{ $article->slug }}</span>
                                </div>
                            </td>

                            <td class="py-4 px-6">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                    {{ $article->category ?? 'Uncategorized' }}
                                </span>
                            </td>

                            <td class="py-4 px-6">
                                @if($article->status === 'published')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Draft
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-6 text-xs text-gray-600">
                                {{ $article->author->name ?? 'Staff' }}
                            </td>

                            <td class="py-4 px-6 text-xs text-gray-500">
                                {{ $article->published_at ? $article->published_at->format('M d, Y') : '—' }}
                            </td>

                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="text-xs font-semibold text-conduit-emerald hover:text-conduit-deep underline">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-400 text-sm">
                                No articles found. Click "New Article" to publish your first story.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
