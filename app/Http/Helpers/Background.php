<?php
namespace App\Http\Helpers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

class Background
{
    //public static $routeName;

    public  function  __construct()
    {
        //$this->routeName = Route::currentRouteName();
    }

    public static function getImage() : string
    {
        $default = '/images/src/background/105_bg.jpg';
        switch(Route::currentRouteName())
            {
                case 'front.index':
                    return $default;
                    break;
                case 'front.catalog.category':
                    $slug = Route::current()->parameters()['slug'];
                    $category = Category::where('slug', $slug)->firstOrFail();
                    $bg = $category->getFirstMediaUrl('bg_category');
                    return $bg ?? $default;
                    break;
                case 'front.catalog.product':
                    $slug = Route::current()->parameters()['slug'];
                    $product = Product::where('slug', $slug)->firstOrFail();
                    $bg = $product->getFirstMediaUrl('bg_product');
                    return $bg ?? $default;
                    break;
                case 'front.article.list':
                    return '/images/src/background/bg_100.jpg';
                    break;
                case 'front.article.item':
                    return '/images/src/background/bg_100.jpg';
                    break;
                case 'front.content.inspiration':
                    return '/images/src/background/bg_100.jpg';
                    break;
                case 'front.content.dealer':
                    return '/images/src/background/erevan.jpg';
                    break;
                case 'front.content.partnership':
                    return '/images/src/background/bg_norvey.jpg';
                    break;
                default:
                    return $default;
                    break;
            }
    }














}
