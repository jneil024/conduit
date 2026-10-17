@extends('layouts.admin')

@section('title', 'Manage Articles')
@section('header', 'Publications Directory')

@section('content')

    <div class="bg-white rounded-xl border border-gray-200 p-5 mb-6 shadow-sm">
        <form method="GET" action="{{ route('admin.articles.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            
            <div class="md:col-span-5 relative">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Search title or excerpt..." 
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
            </div>

            <div class="md:col-span-3">
                <select name="status" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm bg-white focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
                    <option value="">All Statuses</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <select name="category" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm bg-white focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2 flex items-center gap-2">
                <button type="submit" class="flex-grow py-2 px-3 rounded-lg bg-conduit-deep text-white font-semibold text-xs hover:bg-conduit-emerald transition">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'status', 'category']))
                    <a href="{{ route('admin.articles.index') }}" class="py-2 px-3 rounded-lg bg-gray-100 text-gray-600 font-semibold text-xs hover:bg-gray-200 transition" title="Clear Filters">
                        Clear
                    </a>
                @endif
            </div>

        </form>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 font-semibold text-xs uppercase tracking-wider border-b border-gray-200">
                        <th class="py-3.5 px-6">Thumbnail & Title</th>
                        <th class="py-3.5 px-6">Category</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6">Author</th>
                        <th class="py-3.5 px-6">Published At</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($articles as $article)
                        <tr class="hover:bg-gray-50/70 transition">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200">
                                    <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                </div>
                                <div class="max-w-sm">
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="font-semibold text-conduit-deep hover:text-conduit-emerald block line-clamp-1">
                                        {{ $article->title }}
                                    </a>
                                    <span class="text-xs text-gray-400 font-mono block">slug: {{ $article->slug }}</span>
                                </div>
                            </td>

                            <td class="py-4 px-6">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-medium bg-conduit-deep/5 text-conduit-deep">
                                    {{ $article->category ?? 'None' }}
                                </span>
                            </td>

                            <td class="py-4 px-6">
                                @if($article->status === 'published')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Draft
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-6 text-xs text-gray-600">
                                {{ $article->author->name ?? 'Administrator' }}
                            </td>

                            <td class="py-4 px-6 text-xs text-gray-500">
                                {{ $article->published_at ? $article->published_at->format('M d, Y H:i') : 'Unscheduled' }}
                            </td>

                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center gap-3">
                                    @if($article->status === 'published')
                                        <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="text-xs text-gray-500 hover:text-conduit-deep underline">
                                            View
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="text-xs font-semibold text-conduit-emerald hover:text-conduit-deep">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" class="inline" onsubmit="return confirm('Are you sure you want to soft delete this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-semibold text-red-600 hover:text-red-800">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-400 text-sm">
                                No articles found matching your criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $articles->links() }}
        </div>
    </div>

@endsection
