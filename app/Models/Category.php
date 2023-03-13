<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model implements HasMedia
{
    use NodeTrait, HasSlug, InteractsWithMedia;


    protected $table = 'categories';
    protected $fillable = [
        'parent_id',
        '_lft ',
        '_rgt ',
        'name',
        'slug',
        'active',
        'sort',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description',
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
        $this->addMediaCollection('category')
            ->singleFile()
            ->useFallbackPath(public_path('/images/canegory_not_img.jpg'));

        $this->addMediaCollection('bg_category')->singleFile();
    }

    //Relationships
    public function product()
    {
        return $this->hasMany(Product::class);
    }


}
