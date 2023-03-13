<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleFrontController extends Controller
{
    public function list()
    {
        $articles = Article::select('id','name', 'slug', 'active','summary','description')->where('active', 1)->orderBy('sort')->paginate(24);
        return view('front.article.list', compact('articles'));
    }

    public function item($slug)
    {
        $article = Article::where([['active', 1], ['slug', $slug]])->firstOrFail();
        $list = Article::select('id','name', 'slug', 'active')->where('active', 1)->orderBy('sort')->get();
        return view('front.article.item', compact('article', 'list'));
    }



}
