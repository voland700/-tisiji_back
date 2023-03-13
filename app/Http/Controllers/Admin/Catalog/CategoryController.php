<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;

use App\Models\Category;

use Symfony\Component\HttpFoundation\File\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('sort')->get()->toTree();
        return view('admin.catalog.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get()->toTree();
        return view('admin.catalog.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {

        //dd($request->all());
        $data = $request->all();
        $category=new Category($data);
        $category->active=$request->has('active') ? 1 : 0;
        $category::fixTree();
        $category->save();
        if (isset($data['file'])) {
            $category->addMediaFromRequest('file')->toMediaCollection('category');
        }

        if (isset($data['bg_category'])) {
            $category->addMediaFromRequest('bg_category')->toMediaCollection('bg_category');
        }
        return redirect()->route('category.index')->with('success', 'Новая категория создана');
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
        $category = Category::find($id);
        $categories = Category::get()->toTree();
        $media = $category->getMedia('category');
        $bg_category = $category->getMedia('bg_category');

        //$category->image = $media->count()>0 ? pathinfo($category->getFirstMediaUrl('category'), PATHINFO_BASENAME) : 'Нет файла';

        //$category->getFirstMediaUrl('category');
        //dd($category);
        //dd($category->getFirstMediaUrl('category'));
        return view('admin.catalog.category.update', compact('category', 'categories', 'media', 'bg_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $data = $request->all();
        $data['active']=$request->active ? 1 : 0;
        $category::fixTree();
        if (isset($data['file'])) {
            $category->addMediaFromRequest('file')->toMediaCollection('category');
        }
        if (isset($data['bg_category'])) {
            $category->addMediaFromRequest('bg_category')->toMediaCollection('bg_category');
        }
        $category->update($data);
        return redirect()->route('category.index')->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Категория удалена');
    }



    public function imgDelete($id)
    {
        $category=Category::find($id);
        $category->clearMediaCollection('category');
        $resault  = Category::find($id)->getMedia('category');
        if($resault->isEmpty()){
            return ['success'=>200];
        } else {
            return ['success'=>403];
        }
    }

    public function bacgroundDelete($id)
    {
        $category=Category::find($id);
        $category->clearMediaCollection('bg_category');
        $resault  = Category::find($id)->getMedia('bg_category');
        if($resault->isEmpty()){
            return ['success'=>200];
        } else {
            return ['success'=>403];
        }
    }
    public function test() {
        $resault  = Category::find(1)->getMedia('category');
        if($resault->isEmpty()) return 'ПУСТО';
    }




}
