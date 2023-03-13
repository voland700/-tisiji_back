<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;

use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('sort')->get();
        return view('admin.catalog.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catalog.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {

        $data = $request->all();
        $brand= new Brand($data);
        $brand->active=$request->has('active') ? 1 : 0;
        $brand->save();
        if (isset($data['file'])) {
            $brand->addMediaFromRequest('file')->toMediaCollection('brand');
        }
        return redirect()->route('brand.index')->with('success', 'Новый бранд создан');
        //dd($request->all());
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
        $brand = Brand::find($id);
        $media = $brand->getMedia('brand');
        return view('admin.catalog.brand.update', compact('brand', 'media'));
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
        $brand = Brand::find($id);
        $data = $request->all();
        $data['active']=$request->active ? 1 : 0;
        if (isset($data['file'])) {
            $brand->addMediaFromRequest('file')->toMediaCollection('brand');
        }
        $brand->update($data);
        return redirect()->route('brand.index')->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand=Brand::find($id);
        $brand->delete();
        return redirect()->route('brand.index')->with('success', 'Бранд удален');
    }

    public function imgDelete($id)
    {
        $brand=Brand::find($id);
        $brand->clearMediaCollection('brand');
        $resault  = Brand::find($id)->getMedia('brand');
        if($resault->isEmpty()){
            return ['success'=>200];
        } else {
            return ['success'=>403];
        }
    }

}
