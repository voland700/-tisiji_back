<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Название товара" обязательно для заполнения',
            'sort.integer' => 'Номер сортровки должен быть целым числом',
            'doc.*.integer' => 'В поле ID - документа должно быть указано целое число',
            'image.image' => 'Основное изображение - должно быть файлом c изображением',
            'image.mimes' => 'Фал с изображением должен иметь расширение: jpeg, jpg, bmp, png, webp',
            'image.size' => 'Размер фала основного изображения не должен превышать 2 мб.',
            'prev.image' => 'Изображение для анонса - должно быть файлом - картинкой',
            'prev.mimes' => 'Фал с изображением для анонса должен иметь расширение: jpeg, jpg, bmp, png, webp',
            'prev.size' => 'Размер файла с изображенем для анонса не должен превышать 2 мб.',
            'more.*.image' => 'Доплнительноые изображение - должно быть файломи картинками',
            'more.*.mimes' => 'Фалы с доплнительными изображениеми должены иметь расширения: jpeg, jpg, bmp, png, webp',
            'more.*.size' => 'Размер каждого фала с дополнительными изображениями  не должен превышать 2 мб.'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'sort' => 'integer|nullable',
            'doc' => 'array|nullable',
            'doc.*' => 'integer|nullable',
            'image' => 'image|mimes:jpeg,jpg,bmp,png,webp|nullable',
            'image.size' => '2048|nullable',
            'prev' => 'image|mimes:jpeg,jpg,bmp,png,webp|nullable',
            'prev.size' => '2048|nullable',
            'more.*' => 'image|mimes:jpeg,jpg,bmp,png,webp|nullable',
            'more.*.size' => '2048|nullable'
        ];
    }
}
