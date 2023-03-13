<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Imports\DocumentImport;

use App\Imports\AddBackgroudImgToProductImport;

class ImportController extends Controller
{
    public function showUploadForm()
    {
        return view('admin.catalog.import.upload');
    }


    public function UploadData (Request $request)
    {
        $messages = [
            'file.required' => 'Загрузите файл для импорта данных',
            'file.mimes' => 'Файл для иморта данных должен быть в Excel формате',
        ];
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls,csv'
        ],$messages);
        $file = $request->file('file')->store('import');
        $import = new ProductImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return back()->withStatus('Данные загружаются, мы отправим уведомление после завершения импорта.');
    }

    public function showDocumentUploadForm()
    {
        return view('admin.catalog.import.document');
    }




    public function documentUploadData (Request $request)
    {
        $messages = [
            'file.required' => 'Загрузите файл для импорта данных',
            'file.mimes' => 'Файл для иморта данных должен быть в Excel формате',
        ];
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls,csv'
        ],$messages);
        $file = $request->file('file')->store('import');
        $import = new DocumentImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return back()->withStatus('Данные загружаются, мы отправим уведомление после завершения импорта.');
    }

    public function showBackgroundUploadForm()
    {
        return view('admin.catalog.import.background');
    }


    public function backgroundUploadData (Request $request)
    {
        $messages = [
            'file.required' => 'Загрузите файл для импорта данных',
            'file.mimes' => 'Файл для иморта данных должен быть в Excel формате',
        ];
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls,csv'
        ],$messages);
        $file = $request->file('file')->store('import');
        $import = new AddBackgroudImgToProductImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return back()->withStatus('Данные загружаются, мы отправим уведомление после завершения импорта.');
    }




}
