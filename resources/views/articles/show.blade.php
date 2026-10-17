@extends('layouts.app')

@section('title', $article->title . ' — The Conduit')
@section('meta_description', $article->excerpt ?? Str::limit(strip_tags($article->content), 150))

@section('content')

    <div class="bg-white border-b border-gray-200 py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-xs text-gray-500 gap-2 items-center">
                <a href="{{ route('home') }}" class="hover:text-conduit-emerald transition">Home</a>
                <span>/</span>
                <a href="{{ route('articles.index') }}" class="hover:text-conduit-emerald transition">Articles</a>
                @if($article->category)
                    <span>/</span>
                    <a href="{{ route('articles.index', ['category' => $article->category]) }}" class="hover:text-conduit-emerald transition font-medium text-conduit-emerald">
                        {{ $article->category }}
                    </a>
                @endif
            </nav>
        </div>
    </div>

    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($article->category)
            <span class="inline-block bg-conduit-deep text-conduit-light-gold text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4">
                {{ $article->category }}
            </span>
        @endif

        <h1 class="font-display font-extrabold text-3xl sm:text-5xl text-conduit-deep tracking-tight leading-tight mb-6">
            {{ $article->title }}
        </h1>

        <div class="flex items-center gap-4 py-4 border-y border-gray-200 mb-8">
            <div class="w-11 h-11 rounded-full bg-conduit-emerald text-conduit-cream flex items-center justify-center font-bold text-sm uppercase">
                {{ substr($article->author->name ?? 'A', 0, 1) }}
            </div>
            <div>
                <p class="font-semibold text-conduit-deep text-sm">{{ $article->author->name ?? 'Staff Editorial Bureau' }}</p>
                <div class="text-xs text-gray-500 flex items-center gap-2">
                    <time datetime="{{ $article->published_at?->toISOString() }}">
                        {{ $article->published_at ? $article->published_at->format('F d, Y') : 'Recently Published' }}
                    </time>
                    <span>•</span>
                    <span>The Conduit Editorial Staff</span>
                </div>
            </div>
        </div>

        @if($article->featured_image)
            <div class="mb-10 rounded-2xl overflow-hidden shadow-lg border border-gray-200 max-h-[500px]">
                <img src="{{ $article->featured_image_url }}" 
                     alt="{{ $article->title }}" 
                     class="w-full h-full object-cover">
            </div>
        @endif

        @if($article->excerpt)
            <div class="text-lg sm:text-xl font-medium text-conduit-deep/90 leading-relaxed italic border-l-4 border-conduit-gold pl-6 my-8 py-1">
                {{ $article->excerpt }}
            </div>
        @endif

        <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed space-y-6">
            {!! $article->content !!}
        </div>

        <div class="mt-14 p-6 sm:p-8 rounded-2xl bg-white border border-gray-200 shadow-sm flex flex-col sm:flex-row items-center sm:items-start gap-6">
            <div class="w-16 h-16 rounded-full bg-conduit-deep text-conduit-gold flex items-center justify-center font-bold text-xl uppercase flex-shrink-0">
                {{ substr($article->author->name ?? 'A', 0, 1) }}
            </div>
            <div>
                <span class="text-xs uppercase tracking-wider text-conduit-emerald font-bold">Author Profile</span>
                <h3 class="font-display font-bold text-lg text-conduit-deep mt-0.5">{{ $article->author->name ?? 'The Conduit Contributor' }}</h3>
                <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                    Contributing journalist and researcher for The Conduit, focusing on evidence-based healthcare innovation, field ethics, and translational scientific communication.
                </p>
            </div>
        </div>
    </article>

    @if($relatedArticles->count() > 0)
        <section class="bg-white border-t border-gray-200 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-8 flex items-center justify-between">
                    <h2 class="font-display font-bold text-2xl text-conduit-deep">
                        Related in {{ $article->category }}
                    </h2>
                    <a href="{{ route('articles.index', ['category' => $article->category]) }}" class="text-sm font-semibold text-conduit-emerald hover:text-conduit-deep transition">
                        View Category &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $related)
                        <article class="bg-conduit-cream rounded-xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col">
                            <a href="{{ route('articles.show', $related->slug) }}" class="h-44 block overflow-hidden bg-gray-100">
                                <img src="{{ $related->featured_image_url }}" alt="{{ $related->title }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                            </a>
                            <div class="p-5 flex flex-col flex-grow">
                                <span class="text-xs text-gray-500 mb-2">{{ $related->published_at ? $related->published_at->format('M d, Y') : '' }}</span>
                                <h3 class="font-display font-bold text-base text-conduit-deep line-clamp-2 mb-2 hover:text-conduit-emerald transition">
                                    <a href="{{ route('articles.show', $related->slug) }}">
                                        {{ $related->title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-gray-600 line-clamp-2 mt-auto">
                                    {{ $related->excerpt ?? Str::limit(strip_tags($related->content), 80) }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
