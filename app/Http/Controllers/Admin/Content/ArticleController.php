<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('sort')->get();
        return view('admin.content.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *ы
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //return $request->all();
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $article = Article::create($data);
        if ($request->hasFile('image')) {
            $article->addMediaFromRequest('image')->toMediaCollection('article');

        }
        if ($request->hasFile('prev')) {
            $article->addMediaFromRequest('prev')->toMediaCollection('article_prev');

        }
        $article->save();
        return redirect()->route('article.index')->with('success', 'Новая статья созздана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        $image = $article->getMedia('article');
        $prev = $article->getMedia('article_prev');



        return view('admin.content.article.update', compact('article', 'image', 'prev'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, $id)
    {
        $article = Article::find($id);
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $article->addMediaFromRequest('image')->toMediaCollection('article');

        }
        if ($request->hasFile('prev')) {
            $article->addMediaFromRequest('prev')->toMediaCollection('article_prev');

        }

        $article->update($data);
        return redirect()->route('article.index')->with('success', 'Данные успешно изменены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('article.index')->with('success', 'Статья удалена');
    }

    public function img_delete(Request $request)
    {
        $article = Article::find($request->id);
        $article->clearMediaCollection($request->media);
        $resault  = Article::find($request->id)->getMedia($request->media);
        if($resault->isEmpty()){
            return 200;
        } else {
            return 403;
        }
    }

}
