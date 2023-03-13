<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Document;

use Illuminate\Support\Arr;
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

class ProductImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    private $brands;
    private $documents;

    public function __construct()
    {
        $this->brands = Brand::select('id')->get()->toArray();
        $this->documents = Document::select('id')->get()->toArray();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $data = [];
            $data['name'] = $row['name'];
            $data['slug'] = $row['slug'] ? $row['slug'] : NULL;
            $data['active'] = $row['active'] ? 1 : 0;
            $data['main'] = $row['main'] ? 1 : 0;
            $data['sku'] = $row['sku'] ?? NULL;
            $data['eff'] = $row['eff'] ?? NULL;
            $data['color'] = $row['color'] ?? NULL;
            $data['sort'] = $row['sort'] ?? 500;
            $data['brand_id'] = $row['brand_id'] && in_array($row['brand_id'], Arr::flatten($this->brands)) ? $row['brand_id'] : null;
            $data['category_id'] = $row['category_id'] ?? NULL;
            $data['h1'] = $row['h1'] ? $row['h1'] : NULL;
            $data['meta_title'] = $row['meta_title'] ? $row['meta_title'] : NULL;
            $data['meta_keywords'] = $row['meta_keywords'] ?? NULL;
            $data['meta_description'] = $row['meta_description'] ?? NULL;
            $data['summary'] = $row['summary'] ?? NULL;
            $data['description'] = $row['description'] ?? NULL;
            $data['video']  = $row['video'] ?? NULL;
            $data['accessory']  = $row['accessory'] ?? NULL;
            if($row['properties'] != NULL){
                if(is_array(json_decode($row['properties'], true)))  $data['properties'] = $row['properties'];
            } else {
                $data['properties'] = NULL;
            }

            $product = Product::create($data);

            if($row['image']){
                $product->addMedia($row['image'])->preservingOriginal()->toMediaCollection('image');
            }
            if($row['prev']){
                $product->addMedia($row['prev'])->preservingOriginal()->toMediaCollection('prev');
            }
            if($row['more']){
                $images = explode( ',', $row['more'] );
                foreach ($images as $imageItem){
                    $product->addMedia($imageItem)->preservingOriginal()->toMediaCollection('more');
                }
            }
            if($row['documents']) {
                $documents = explode( ',', $row['documents'] );
                $arrID = [];
                foreach ($documents as $id ){
                    if(in_array($id, Arr::flatten($this->documents))) array_push($arrID, $id );
                }
                $product->documents()->attach($arrID);
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
            'name' => [
                'required',
                'string',
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
