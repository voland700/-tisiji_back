<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Document;
use App\Models\Brand;
use App\Models\Property;

class ProductController extends Controller
{
    public function list($id=NULL)
    {
        if($id){
            $DataCategories = Category::descendantsAndSelf($id);
            $category_name = Category::find($id)->name;
            $products = Product::whereIn('category_id', $DataCategories->pluck('id'))->with(
                ['category' => function($q){$q->select('id','name'); }]
            )->select('id', 'name', 'sort', 'active', 'category_id', 'main')->orderBy('sort', 'asc')->get();
        }else{
            $category_name = null;
            $products = Product::with(
                ['category' => function($q){$q->select('id','name'); }]
            )->select('id', 'name', 'sort', 'active', 'category_id', 'main')->orderBy('sort', 'asc')->get();
        }
        return view('admin.catalog.product.index', compact( 'category_name', 'products', 'id'));


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=NULL)
    {
        $categories = Category::all()->toTree();
        $properties = Property::all()->sortBy('sort');
        $brands = Brand::all()->sortBy('sort');
        $category_id = $id;
        return view('admin.catalog.product.create', compact('categories', 'category_id', 'brands', 'properties'));
    }

    /**
     * Store a newly created resource in storage.
     *ы
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['main'] = $request->has('main') ? 1 : 0;
        $data['category_id'] = $request->category_id ?? 0;
        $data['video'] = $request->video ? json_encode($properties) : null;
        $properties = [];
        if($data['properties']){
            foreach ($data['properties'] as $key => $property){
                if($property['value'] !== null){
                    $properties[$key] = $property;
                }
            }
        }
        $data['properties'] = json_encode($properties,JSON_UNESCAPED_UNICODE);

        $product = Product::create($data);

        $arrDocs = [];
        $arrIdDocs = Document::pluck('id')->toArray();
        foreach ($request->doc as $document){
            if($document !== null && in_array($document, $arrIdDocs))  array_push($arrDocs, $document);
        }
        if($arrDocs) {
            $product->documents()->sync($arrDocs);
        }
        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('image');

        }
        if ($request->hasFile('prev')) {
            $product->addMediaFromRequest('prev')->toMediaCollection('prev');
        }

        if ($request->hasFile('bg_product')) {
            $product->addMediaFromRequest('bg_product')->toMediaCollection('bg_product');
        }

        if ($request->hasFile('more')) {
            foreach ($request->file('more') as $img) {
                $product->addMedia($img)->toMediaCollection('more');
            }
        }
        $product->update($data);
        return redirect()->route('product.list', $data['category_id'] )->with('success', 'Новый товар созздан');

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
        $product = Product::with('documents')->find($id);
        $categories = Category::all()->toTree();
        $brands = Brand::all()->sortBy('sort');
        $properties = json_decode($product->properties, true);
        $video =  $product->video ? json_decode($product->video, true) : [];
        //dd($properties);
        $image = $product->getMedia('image');
        $prev = $product->getMedia('prev');
        $more = $product->getMedia('more');
        $bg_product = $product->getMedia('bg_product');
        return view('admin.catalog.product.update', compact('product', 'categories', 'brands', 'properties', 'video', 'image', 'prev', 'more', 'bg_product'));
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
        $product = Product::find($id);
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['main'] = $request->has('main') ? 1 : 0;
        $data['category_id'] = $request->category_id ?? 0;
        $data['video'] = $request->video ?? null;

        $properties = [];
        if(array_key_exists('properties', $data)){
            foreach ($data['properties'] as $key => $property){
                if($property['value'] !== null){
                    $properties[$key] = $property;
                }
            }
        }
        $data['properties'] = json_encode($properties,JSON_UNESCAPED_UNICODE);



        $arrDocs = [];
        $arrIdDocs = Document::pluck('id')->toArray();
        foreach ($request->doc as $document){
            if($document !== null && in_array($document, $arrIdDocs))  array_push($arrDocs, $document);
        }
        if($arrDocs) {
            $product->documents()->sync($arrDocs);
        }

        if($arrDocs) {
            $product->documents()->sync($arrDocs);
        }

        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('image');

        }

        if ($request->hasFile('prev')) {
            $product->addMediaFromRequest('prev')->toMediaCollection('prev');
        }

        if ($request->hasFile('bg_product')) {
            $product->addMediaFromRequest('bg_product')->toMediaCollection('bg_product');
        }

        if ($request->hasFile('more')) {
            foreach ($request->file('more') as $img) {
                $product->addMedia($img)->toMediaCollection('more');
            }
        }

        $product->update($data);
        return redirect()->route('product.list', $data['category_id'] )->with('success', 'Данные товара успешно изменены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.list')->with('success', 'Товар удален');
    }


    public function img_delete(Request $request)
    {
        //return $request->media;
        $product = Product::find($request->id);
        if($request->media == 'image' || $request->media == 'prev' || $request->media == 'bg_product'){
            $product->clearMediaCollection($request->media);
            return 200;
            //return $product->getMedia($request->media);
        }elseif($request->media == 'more'){
            $media = $product->getMedia('more');
            $media[$request->number]->delete();
            return 200;
        }else {
            return 403;
        }
    }
}
