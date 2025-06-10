<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\BlogCategory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class BlogPost extends Model
{
    use HasSlug;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getNextPost()
    {
        return self::where('published', true)
                ->where('created_at', '>', $this->created_at)
                ->orderBy('created_at', 'asc')
                ->first();
    }

    public function getPreviousPost()
    {
        return self::where('published', true)
                ->where('created_at', '<', $this->created_at)
                ->orderBy('created_at', 'desc')
                ->first();
    }

    protected $fillable = [
        'title',
        'slug',
        'published',
        'content',
        'visits_count'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_post_category');
    }

    public function casts()
    {
        return [
            'published' => 'boolean'
        ];
    }
}
