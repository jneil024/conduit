<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'user_id',
        'status',
        'published_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Boot model events for slug generation and published timestamps.
     */
    protected static function booted(): void
    {
        static::saving(function (Article $article) {
            if (empty($article->slug) && ! empty($article->title)) {
                $baseSlug = Str::slug($article->title);
                $slug = $baseSlug;
                $counter = 1;

                while (static::where('slug', $slug)->where('id', '!=', $article->id ?? 0)->exists()) {
                    $slug = "{$baseSlug}-{$counter}";
                    $counter++;
                }

                $article->slug = $slug;
            }

            if ($article->status === 'published' && is_null($article->published_at)) {
                $article->published_at = now();
            }
        });
    }

    /**
     * Author relationship.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope to only include published articles.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Featured image public URL accessor.
     */
    public function getFeaturedImageUrlAttribute(): string
    {
        if (empty($this->featured_image)) {
            return 'https://picsum.photos/800/500?random=' . ($this->id ?? 1);
        }

        if (Str::startsWith($this->featured_image, ['http://', 'https://'])) {
            return $this->featured_image;
        }

        $cleanPath = Str::startsWith($this->featured_image, 'storage/')
            ? $this->featured_image
            : 'storage/' . ltrim($this->featured_image, '/');

        return asset($cleanPath);
    }
}
