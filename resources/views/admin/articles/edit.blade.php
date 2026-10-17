@extends('layouts.admin')

@section('title', 'Edit Article: ' . $article->title)
@section('header', 'Edit Article')

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: '#content',
                height: 480,
                menubar: true,
                plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
                toolbar: 'undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image table | code',
                content_style: 'body { font-family: Inter, sans-serif; font-size: 15px; color: #1A1A1A; }'
            });
        });
    </script>
@endpush

@section('content')

    <div class="max-w-4xl mx-auto">
        <div class="mb-4 flex items-center justify-between">
            <a href="{{ route('admin.articles.index') }}" class="text-xs font-semibold text-conduit-emerald hover:text-conduit-deep inline-flex items-center gap-1">
                &larr; Return to Articles Directory
            </a>
            @if($article->status === 'published')
                <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="text-xs font-semibold text-conduit-gold hover:underline">
                    View Published Live &rarr;
                </a>
            @endif
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8">
            <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.articles._form')
            </form>
        </div>
    </div>

@endsection
