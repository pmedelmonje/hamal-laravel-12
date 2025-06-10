<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
{

    use HasSlug;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected $fillable = [
        'project_type_id',
        'name',
        'slug',
        'technologies',
        'url',
        'short_description',
        'description',
        'filename',
        'filepath',
        'is_visible'
    ];

    protected function casts()
    {
        return [
            'is_visible' => 'boolean'
        ];
    }

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }
}
