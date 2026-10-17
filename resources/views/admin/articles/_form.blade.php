<div class="space-y-6">

    <div>
        <label for="title" class="block text-sm font-semibold text-conduit-deep mb-1">
            Article Title <span class="text-red-500">*</span>
        </label>
        <input type="text" 
               id="title" 
               name="title" 
               value="{{ old('title', $article->title ?? '') }}" 
               required 
               maxlength="200"
               placeholder="e.g. Diagnostic Frontiers: AI in Modern Clinical Practice" 
               class="w-full px-4 py-2.5 rounded-lg border @error('title') border-red-500 @else border-gray-300 @enderror text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
        @error('title')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="slug" class="block text-sm font-semibold text-conduit-deep mb-1">
            URL Slug <span class="text-xs font-normal text-gray-500">(Auto-generated or custom)</span>
        </label>
        <input type="text" 
               id="slug" 
               name="slug" 
               value="{{ old('slug', $article->slug ?? '') }}" 
               placeholder="diagnostic-frontiers-ai" 
               class="w-full px-4 py-2.5 rounded-lg border @error('slug') border-red-500 @else border-gray-300 @enderror text-sm font-mono text-gray-700 focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
        @error('slug')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div>
            <label for="category" class="block text-sm font-semibold text-conduit-deep mb-1">
                Category
            </label>
            <input type="text" 
                   id="category" 
                   name="category" 
                   list="category-options"
                   value="{{ old('category', $article->category ?? '') }}" 
                   placeholder="e.g. News, Multimedia" 
                   class="w-full px-3.5 py-2.5 rounded-lg border @error('category') border-red-500 @else border-gray-300 @enderror text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
            <datalist id="category-options">
                <option value="News">
                <option value="Feature">
                <option value="Multimedia">
                <option value="Opinion">
                <option value="Investigative">
            </datalist>
            @error('category')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="status" class="block text-sm font-semibold text-conduit-deep mb-1">
                Status <span class="text-red-500">*</span>
            </label>
            <select id="status" 
                    name="status" 
                    required 
                    class="w-full px-3.5 py-2.5 rounded-lg border @error('status') border-red-500 @else border-gray-300 @enderror text-sm bg-white focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
                <option value="draft" {{ old('status', $article->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $article->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="published_at" class="block text-sm font-semibold text-conduit-deep mb-1">
                Publish Date
            </label>
            <input type="datetime-local" 
                   id="published_at" 
                   name="published_at" 
                   value="{{ old('published_at', isset($article->published_at) ? $article->published_at->format('Y-m-d\TH:i') : '') }}" 
                   class="w-full px-3.5 py-2.5 rounded-lg border @error('published_at') border-red-500 @else border-gray-300 @enderror text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
            <span class="text-[11px] text-gray-400">Leave blank to auto-set upon publishing.</span>
            @error('published_at')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="featured_image" class="block text-sm font-semibold text-conduit-deep mb-1">
            Featured Image <span class="text-xs font-normal text-gray-500">(JPG, PNG, WEBP — Max 2MB)</span>
        </label>
        
        <div class="mt-1 flex items-center gap-6">
            @if(isset($article) && $article->featured_image)
                <div class="w-24 h-16 rounded-lg bg-gray-100 overflow-hidden border border-gray-200 flex-shrink-0">
                    <img src="{{ $article->featured_image_url }}" alt="Existing image" class="w-full h-full object-cover">
                </div>
            @endif
            <input type="file" 
                   id="featured_image" 
                   name="featured_image" 
                   accept="image/jpeg,image/png,image/webp" 
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-conduit-deep file:text-white hover:file:bg-conduit-emerald file:cursor-pointer">
        </div>
        @error('featured_image')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="excerpt" class="block text-sm font-semibold text-conduit-deep mb-1">
            Summary Excerpt <span class="text-xs font-normal text-gray-500">(Max 500 characters)</span>
        </label>
        <textarea id="excerpt" 
                  name="excerpt" 
                  rows="3" 
                  maxlength="500" 
                  placeholder="Provide a concise summary of the article for catalog cards and social previews..." 
                  class="w-full px-4 py-2.5 rounded-lg border @error('excerpt') border-red-500 @else border-gray-300 @enderror text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
        @error('excerpt')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="content" class="block text-sm font-semibold text-conduit-deep mb-1">
            Article Content <span class="text-red-500">*</span>
        </label>
        <textarea id="content" 
                  name="content" 
                  rows="12" 
                  class="w-full px-4 py-2.5 rounded-lg border @error('content') border-red-500 @else border-gray-300 @enderror text-sm">{{ old('content', $article->content ?? '') }}</textarea>
        @error('content')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="pt-6 border-t border-gray-200 flex items-center justify-between">
        <a href="{{ route('admin.articles.index') }}" class="px-5 py-2.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-sm transition">
            Cancel
        </a>
        <button type="submit" class="px-7 py-2.5 rounded-lg bg-conduit-gold hover:bg-conduit-light-gold text-conduit-deep font-display font-bold text-sm shadow-md transition transform hover:-translate-y-0.5">
            {{ isset($article->id) ? 'Update Publication' : 'Save Publication' }}
        </button>
    </div>

</div>
