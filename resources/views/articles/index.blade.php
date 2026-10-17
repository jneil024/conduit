@extends('layouts.app')

@section('title', 'Publication Archive — The Conduit')

@section('content')

    <div class="bg-conduit-deep text-conduit-cream py-14 border-b border-conduit-emerald/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs uppercase tracking-widest font-bold text-conduit-gold">Editorial Library</span>
            <h1 class="font-display font-bold text-3xl sm:text-5xl text-white mt-1">Articles & Publications</h1>
            <p class="text-conduit-cream/80 text-sm sm:text-base mt-2 max-w-2xl">
                Explore independent investigations, multimedia field dispatches, and clinical essays published by The Conduit.
            </p>
        </div>
    </div>

    <div class="bg-white border-b border-gray-200 py-6 sticky top-20 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('articles.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                
                <div class="md:col-span-6 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Search titles, excerpts, or content..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-conduit-emerald text-sm">
                </div>

                <div class="md:col-span-4">
                    <select name="category" class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-conduit-emerald text-sm bg-white">
                        <option value="">All Editorial Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2 flex items-center gap-2">
                    <button type="submit" class="flex-grow py-2.5 px-4 rounded-lg bg-conduit-gold hover:bg-conduit-light-gold text-conduit-deep font-bold text-sm shadow transition">
                        Filter
                    </button>
                    @if(request()->hasAny(['search', 'category']))
                        <a href="{{ route('articles.index') }}" class="p-2.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold transition" title="Clear Filters">
                            &times;
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                    <article class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col overflow-hidden group">
                        
                        <a href="{{ route('articles.show', $article->slug) }}" class="relative block h-52 overflow-hidden bg-gray-100">
                            <img src="{{ $article->featured_image_url }}" 
                                 alt="{{ $article->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @if($article->category)
                                <span class="absolute top-4 left-4 bg-conduit-deep/90 backdrop-blur-sm text-conduit-light-gold text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                                    {{ $article->category }}
                                </span>
                            @endif
                        </a>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="text-xs text-gray-500 mb-2.5 flex items-center gap-2">
                                <span>{{ $article->published_at ? $article->published_at->format('M d, Y') : 'Recent' }}</span>
                                <span>•</span>
                                <span>By {{ $article->author->name ?? 'Staff Contributor' }}</span>
                            </div>

                            <h2 class="font-display font-bold text-xl text-conduit-deep group-hover:text-conduit-emerald transition line-clamp-2 mb-3">
                                <a href="{{ route('articles.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h2>

                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-6 flex-grow">
                                {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
                            </p>

                            <div class="pt-4 border-t border-gray-100 mt-auto flex items-center justify-between">
                                <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center gap-1 font-semibold text-sm text-conduit-emerald group-hover:text-conduit-deep transition">
                                    Read Full Article
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>

                    </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-gray-300">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <h3 class="font-display font-bold text-xl text-gray-700 mb-2">No Matching Publications Found</h3>
                <p class="text-gray-500 text-sm max-w-md mx-auto mb-6">We could not find any articles matching your search query or selected category.</p>
                <a href="{{ route('articles.index') }}" class="inline-flex items-center px-5 py-2.5 rounded-lg bg-conduit-emerald text-white font-semibold text-sm hover:bg-conduit-deep transition">
                    Reset All Filters
                </a>
            </div>
        @endif
    </div>

@endsection
