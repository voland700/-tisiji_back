<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Brand extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $table = 'brands';
    protected $fillable = [
        'name',
        'active',
        'sort'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('brand')
            ->singleFile()
            ->useFallbackPath(public_path('/images/canegory_not_img.jpg'));
    }

    //Relationships
    public function product()
    {
        return $this->hasMany(Product::class);
    }

}
