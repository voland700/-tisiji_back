<?php

namespace App\Imports;

use App\Models\Product;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Events\AfterImport;



class AddBackgroudImgToProductImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            if($row['file']){
                $product = Product::find($row['id']);
                $product->addMedia($row['file'])->preservingOriginal()->toMediaCollection('bg_product');
            }
        }
    }
    public function startRow(): int
    {
        return 2;
    }
    public function headingRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
            ],
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
    /*
        public static function afterImport(AfterImport $event)
        {
        }
    */
    public function onFailure(Failure ...$failure)
    {

    }

}
