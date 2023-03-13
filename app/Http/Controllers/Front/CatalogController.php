<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;

class CatalogController extends Controller
{
    public function index()
    {
        $categories = Category::select('_lft', '_rgt', 'parent_id', 'id','name', 'slug', 'active')->where('active', 1)->withDepth()->having('depth', '<', 2)->get()->toTree();
        return view('front.catalog.index', compact('categories'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = $category->children;
        $categoriesId = $category->descendants()->pluck('id');
        $categoriesId[] = $category->getKey();
        $products = Product::whereIn('category_id', $categoriesId)->where('active', 1)->orderBy('sort')->paginate(24);
        return view('front.catalog.category', compact( 'categories', 'category','products'));
    }

    public function product($slug)
    {

        $product = Product::with('brand', 'documents')->where([['active', 1], ['slug', $slug]])->firstOrFail();
        $image = $product->getFirstMediaUrl('image');
        $miniature = $product->getFirstMediaUrl('image', 'miniature');

        $category = Category::where('id', $product->category_id)->firstOrFail();
        $RootCategory = Category::ancestorsAndSelf($product->category_id)->where('parent_id', NULL)[0]['id'];
        $AllCategories = Category::find($RootCategory);
        $categories = $AllCategories::descendantsAndSelf($RootCategory)->pluck('id');
        $categories[] = $AllCategories->getKey();
        $products =  Product::whereIn('category_id', $categories)->where([['id', '!=', $product->id], ['active', 1]])->select('id','name', 'slug', 'active')->inRandomOrder()->take(4)->get();

        $product->properties =  $product->properties ? json_decode($product->properties) : null;
        $product->video = $product->video ? json_decode($product->video) : null;
        //dd($product->documents->isNotEmpty());
        return view('front.catalog.product', compact('product', 'products', 'category', 'image', 'miniature'));
    }

    public function search(Request $request)
    {
       // dd($request->all());
        $s = $request->s;
        $request->validate([
            's' => 'required',
        ]);
        $products = Product::like($request->s)->where('active', 1)->paginate(24);
        return view('front.catalog.search', compact('s', 'products'));
    }
}
