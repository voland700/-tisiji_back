<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Product extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;
    protected $table = 'products';
    protected $fillable = [
        'active',
        'main',
        'name',
        'slug',
        'sku',
        'eff',
        'sort',
        'brand_id',
        'category_id',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'summary',
        'description',
        'properties',
        'video',
        'accessory',
        'color'
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
        $this->addMediaCollection('image')
            ->singleFile()
            ->useFallbackPath(public_path('/images/not_photo.jpg'))
            ->registerMediaConversions(
                function () {
                $this
                    ->addMediaConversion('miniature')
                    ->crop('crop-center', 100, 100);
            });

        $this->addMediaCollection('prev')
            ->singleFile()
            ->useFallbackPath(public_path('/images/canegory_not_img.jpg'));

        $this->addMediaCollection('more')
            ->registerMediaConversions(
                function () {
                $this
                    ->addMediaConversion('thumb')
                    ->crop('crop-center', 100, 100);

            });
        $this->addMediaCollection('bg_product')->singleFile();
    }





    //Relationships
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function getCategoryParentAttribute()
    {
        if(!$this->category_id==NULL){
            return  $this->category->name;
        }else{
            return 'Категория не задана';
        }
    }

    public function getEffectivityAttribute(): null|string
    {

        if(!$this->eff) return null;
        return match($this->eff){
            'A++' => '#eff-a2plas',
            'A+' => '#eff-aplas',
            'A' => '#eff-a',
            'B' => '#eff-b',
            'C' => '#eff-c',
            default => null,
        };
    }
    public function scopeLike($query, $s)
    {

        $s= iconv_substr($s, 0, 64);
        $s = preg_replace('#[^0-9a-zA-ZА-Яа-яёЁ]#u', ' ', $s);
        $s = preg_replace('#\s+#u', ' ', $s);
        $s = trim($s);

        if (empty($s)) {
            return $query->whereNull('id'); // возвращаем пустой результат
        }
        $temp = explode(' ', $s);
        $words = [];
        $stemmer = new \App\Http\Helpers\LinguaStemRu;
        foreach ($temp as $item) {
            if (iconv_strlen($item) > 3) {
                $words[] = $stemmer->stem_word($item);
            } else {
                $words[] = $item;
            }
        }
        $relevance = "IF (`products`.`name` LIKE '%" . $words[0] . "%', 2, 0)";
        for ($i = 1; $i < count($words); $i++) {
            $relevance .= " + IF (`products`.`name` LIKE '%" . $words[$i] . "%', 2, 0)";
        }
        $query->select('products.*', \DB::raw($relevance . ' as relevance'))
            ->where('products.name', 'like', '%' . $words[0] . '%');
        for ($i = 1; $i < count($words); $i++) {
            $query = $query->orWhere('products.name', 'like', '%' . $words[$i] . '%');
        }
        $query->orderBy('relevance', 'desc');
        return $query;
    }
}
