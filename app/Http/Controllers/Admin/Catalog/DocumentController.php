<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::get();
        return view('admin.content.document.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name' => 'Поле - Наименование документа обязательно для заполнения'
        ];
        $this->validate($request, [
            'name' => 'required',
        ], $messages);

        $data = $request->all();
        $document = new Document($data);
        if (isset($data['file'])) {
            $document->addMediaFromRequest('file')
            ->sanitizingFileName(function($fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })->toMediaCollection('document');
        }
        $document->save();
        return redirect()->route('document.index')->with('success', 'Файл загружен');
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
        $document = Document::find($id);
        $media = $document->getMedia('document');
        return view('admin.content.document.update', compact('document', 'media'));
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
        $messages = [
            'name' => 'Поле - Наименование документа обязательно для заполнения'
        ];
        $this->validate($request, [
            'name' => 'required',
        ], $messages);

        $document = Document::find($id);
        $data = $request->all();
        $data['active']=$request->active ? 1 : 0;
        if (isset($data['file'])) {
            $document->addMediaFromRequest('file')
            ->sanitizingFileName(function($fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })->toMediaCollection('document');
        }
        $document->update($data);
        return redirect()->route('document.index')->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::find($id);
        $document->delete();
        return redirect()->route('document.index')->with('success', 'Документ удалён');
    }

    public function fileDelete($id)
    {
        $document = Document::find($id);
        $document->clearMediaCollection('document');
        $resault  = Document::find($id)->getMedia('document');
        if($resault->isEmpty()){
            return ['success'=>200];
        } else {
            return ['success'=>403];
        }
    }

}
