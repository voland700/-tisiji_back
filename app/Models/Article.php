<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;


class Article extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;
    protected $table = 'articles';
    protected $fillable = [
        'active',
        'name',
        'slug',
        'sort',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'summary',
        'description'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('article')
            ->singleFile();
        $this->addMediaCollection('article_prev')
            ->singleFile();
    }

    //Accessors
    public function getPreviewAttribute()
    {
        if(!$this->summary==NULL){
            return Str::limit($this->summary, 120, ' (...)');
        } else {
            return  $this->description ?  Str::limit($this->description, 120, ' (...)') : null;
        }
    }





}
