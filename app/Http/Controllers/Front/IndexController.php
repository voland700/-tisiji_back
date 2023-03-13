<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;
use App\Models\Product;

class IndexController extends Controller
{

    public function index()
    {
        $products = Product::where([['main', 1], ['active', 1]])->select('id', 'name', 'main', 'slug', 'active')->take(4)->get();
        return view('front.index', compact('products'));
    }

}
