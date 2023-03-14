@extends('adminlte::page')

@section('title', 'Редактирование товара {{ $product->name}}')

@section('content_header')
    <h1>Редактирование товара: {{ $product->name}}</h1>
@stop

@section('content')

    @if (count($errors) > 0)
    <x-adminlte-alert theme="danger" class="col-lg-6"  dismissable>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-adminlte-alert>
    @endif



    <form role="form" method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

    <div class="row">

        <div class="col-lg-6">

            <x-adminlte-card title="Данные товара" body-class="pb-3" collapsible removable maximizable>

                @php
                    $config = [
                        'state' => $product->active,
                     ];
                @endphp
                <x-adminlte-input-switch name="active" data-on-color="success" data-off-color="danger" :config="$config" checked/>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="main" name="main" @if($product->main) checked @endif >
                        <label for="main" class="custom-control-label">Товар на главной</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="{{old('sort', $product->sort)}}">
                    </div>
                    <label for="sort" class="col-sm-4 col-form-label">Сортировка</label>
                </div>

                <x-adminlte-input name="sku" label="Артикул" fgroup-class="col-4" value="{{ old('sku', $product->sku) }}" enable-old-support/>

                <x-adminlte-input name="name" label="Название товара" placeholder="Название товара" value="{{ old('name', $product->name) }}" fgroup-class="col-12" enable-old-support>
                    <x-slot name="bottomSlot">
                        <span class="text-sm text-gray">Обязательно для заполенения</span>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="slug" label="URL - slug" placeholder="slug"  value="{{ old('slug', $product->slug) }}" fgroup-class="col-12" enable-old-support/>

                <x-adminlte-select-bs name="category_id" fgroup-class="col-12" label="Выбор родительской категории">
                    @php
                        if($product->category_id == NULL){
                            echo '<option  value="NULL" selected >-&ensp; Нет категории</option>';
                        } else {
                            echo '<option  value="NULL" class="text-black-50">-&ensp; Нет категории</option>';
                        }
                        $traverse = function ($categories, $prefix = '-&ensp;', $category_id = 'NULL') use (&$traverse) {
                            foreach ($categories as $category) {
                                $selected = ($category_id == $category->id) ? 'selected' : '';
                                echo '<option  value="'.$category->id.'"'.$selected.'>'.PHP_EOL.$prefix.' '.$category->name.'</option>';
                                $traverse($category->children, $prefix.'-&ensp;', $category_id);
                                }
                            };
                        $traverse($categories, '-&ensp;', $product->category_id);
                    @endphp
                </x-adminlte-select-bs>



                <div class="row">
                    <x-adminlte-select name="brand_id" fgroup-class="col-6" label="Бренд">

                        <option value="" @if($product->brand_id == null) selected @endif>Не указан</option>
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}" @if($product->brand_id == $brand->id) selected @endif>{{$brand->name}}</option>
                        @endforeach
                    </x-adminlte-select>
                    <x-adminlte-select name="eff" fgroup-class="col-6" label="Энергоэффективность">
                        <option value="" @if($product->eff == null) selected @endif>Не указан</option>
                        <option value="A++" @if($product->eff == 'A++') selected @endif>A++</option>
                        <option value="A+" @if($product->eff == 'A+') selected @endif>A+</option>
                        <option value="A" @if($product->eff == 'A') selected @endif>A</option>
                        <option value="B" @if($product->eff == 'B') selected @endif>B</option>
                        <option value="C" @if($product->eff == 'C') selected @endif>C</option>
                    </x-adminlte-select>
                </div>
                <div class="row">
                    <x-adminlte-input name="color" label="Цвет" placeholder="Цвет товара" value="{{ old('color', $product->color) }}" fgroup-class="col-6" enable-old-support>
                    </x-adminlte-input>
                </div>



                <p class="small_title">Изображения товра</p>

                <div class="row mb-4">
                    <div class="col-6 img_product_wrap" data-media="image">
                        @if($image->count()>0)

                        <div class="item_img_wrap">
                            <div class="item_img" data-number="0">
                                {{$prev[0]}}
                                <a href="{{route('product.img.delete')}}" class="img-del" title="Удалить"><i class="fa fa-sm fa-fw fa-trash"></i></a>
                            </div>
                            <span class="item_img_name">{{ basename($prev[0]->getFullUrl()).PHP_EOL; }}</span>
                        </div>

                        @endif
                        <x-adminlte-input-file name="image" igroup-size="sm" label="Основное изображение" placeholder="Основное изображение">
                            <x-slot name="image">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                    <div class="col-6 img_product_wrap" data-media="prev">
                        @if($prev->count()>0)

                        <div class="item_img_wrap">
                            <div class="item_img" data-number="0">
                                {{$prev[0]}}
                                <a href="{{route('product.img.delete')}}" class="img-del" title="Удалить"><i class="fa fa-sm fa-fw fa-trash"></i></a>
                            </div>
                            <span class="item_img_name">{{ basename($prev[0]->getFullUrl()).PHP_EOL; }}</span>
                        </div>

                        @endif

                        <x-adminlte-input-file name="prev" igroup-size="sm" label="Preview изображения" placeholder="Preview изображения">
                            <x-slot name="prev">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                </div>

                <div class="mb-2">
                    <div class="images_product_wrap" data-media="more">
                        @if($more->count()>0)
                            @for ($i = 0; $i < $more->count(); $i++)

                            <div class="item_img_wrap">
                                <div class="item_img" data-number="{{$i}}">
                                    {{$more[$i]}}
                                    <a href="{{route('product.img.delete')}}" class="img-del" title="Удалить"><i class="fa fa-sm fa-fw fa-trash"></i></a>
                                </div>
                                <span class="item_img_name">{{ basename($more[$i]->getFullUrl()).PHP_EOL; }}</span>
                            </div>
                            @endfor
                        @endif
                    </div>
                    <x-adminlte-input-file id="more" name="more[]" label="Дополнительные изображения"
                        placeholder="Choose multiple files..." igroup-size="lg" legend="Choose" multiple>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-file-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>

                <div class="row mb-4">
                    <div class="col-6 img_product_wrap" data-media="bg_product">
                        @if($bg_product->count()>0)

                            <div class="item_img_wrap">
                                <div class="item_img" data-number="0">
                                    {{$bg_product[0]}}
                                    <a href="{{route('product.img.delete')}}" class="img-del" title="Удалить"><i class="fa fa-sm fa-fw fa-trash"></i></a>
                                </div>
                                <span class="item_img_name">{{ basename($bg_product[0]->getFullUrl()).PHP_EOL; }}</span>
                            </div>

                        @endif
                        <x-adminlte-input-file name="bg_product" igroup-size="sm" label="Фоновое изображение в шапке сайта" placeholder="Изображение">
                            <x-slot name="image">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                    <div class="col-6"></div>
                </div>








                <p class="small_title">Документы для товара</p>

                <div class="row">
                    <div class="col-12" id="Docs">
                        <label for="doc" class="col-sm-6 col-form-label">ID Документа</label>
                        @forelse ($product->documents as $document)
                        <div class="col-sm-3">
                            <input type="number" class="form-control mb-2 @error('doc') is-invalid @enderror"  name="doc[]"   value="{{ $document->id }}">
                        </div>
                        @empty
                        <div class="col-sm-3">
                            <input type="number" class="form-control mb-2 @error('doc') is-invalid @enderror"  name="doc[]"   value="{{ old('doc[]') }}">
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="row pt-2 mb-3">
                    <div class="col-6"><button class="btn btn-outline-secondary btn-sm" id="addDoc">Добавить</button></div>
                </div>

                <p class="small_title">Видео для товара</p>
                <div class="row">
                    <div class="col-12" id="videoBlock">
                        <label for="doc" class="col-sm-6 col-form-label">ID YouTube - ролика</label>
                        @forelse ($video as $video_item)
                        <div class="col-12">
                            <input type="text" class="form-control mb-2"  name="video[]"   value="{{ $video_item }}">
                        </div>
                        @empty
                        <div class="col-12">
                            <input type="text" class="form-control mb-2"  name="video[]" value="">
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="row pt-2 mb-3">
                    <div class="col-6"><button class="btn btn-outline-secondary btn-sm" id="addVideo">Добавить</button></div>
                </div>
                <x-adminlte-textarea name="accessory" label="Аксессуары (HTML table)" fgroup-class="col-12" enable-old-support>{{old('accessory', $product->accessory)}}</x-adminlte-textarea>
                <x-slot name="footerSlot">
                    <p></p>
                </x-slot>
            </x-adminlte-card>
        </div>

        <div class="col-lg-6">
            <x-adminlte-card title="Характерристики товара" body-class="pb-3" collapsible removable maximizable>
                <div id="propertiesList">
                @if($properties)
                    @foreach ($properties as $key=>$property)
                        <div class="form-group row">
                            <div class="col-sm-6 text-lg-right">
                                <input type="text" name="properties[{{ $key }}][name]" value="{{ old('properties['.$key.'][name]', $property['name']) }}" class="form-control">
                            </div>
                            <div class="col-sm-6 d-flex align-items-center">
                                <input type="text" name="properties[{{ $key }}][value]" value="{{ old('properties['.$key.'][value]', $property['value']) }}" class="form-control">
                            </div>
                        </div>
                    @endforeach
                @endif
                </div>
                <div class="row pt-3">
                    <div class="col-6"> <button class="btn btn-outline-secondary btn-sm" id="addProperties">Добавить</button> </div>
                </div>
                <template id="tmplProperty">
                    <div class="form-group row">
                        <div class="col-sm-6 text-lg-right">
                            <input type="text" name=""  class="form-control name" placeholder="Название...">
                        </div>
                        <div class="col-sm-6 d-flex align-items-center">
                            <input type="text" name="" class="form-control value" placeholder="Значение...">
                        </div>
                    </div>
                </template>
                <x-slot name="footerSlot">
                    <p></p>
                </x-slot>
            </x-adminlte-card>
        </div>

        <div class="col-lg-12">
            <x-adminlte-card title="Описание, СЕО данные товара" body-class="pb-3" collapsible removable maximizable>
                <x-adminlte-input name="h1" label="Заголовок H1 категории" fgroup-class="col-12" value="{{ old('h1', $product->h1) }}" enable-old-support/>
                <x-adminlte-input name="meta_title" label="META - title" fgroup-class="col-12" value="{{old('meta_title', $product->meta_title)}}" enable-old-support/>
                <x-adminlte-input name="meta_keywords" label="META - keywords" fgroup-class="col-12" value="{{old('meta_keywords', $product->meta_keywords)}}" enable-old-support/>
                <x-adminlte-textarea name="meta_description" label="META - description" fgroup-class="col-12" enable-old-support>{{old('meta_description', $product->meta_description)}}</x-adminlte-textarea>
                <h4 class="col-lg-9 mt-3 mb-2">Описание категории товаров</h4>
                <x-adminlte-text-editor name="description" fgroup-class="col-12">{{old('description', $product->description)}}</x-adminlte-text-editor>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Сохранить" type="submit" class="d-flex ml-auto" theme="primary" />
                </x-slot>
            </x-adminlte-card>
        </div>
    </div>




    </form>
@stop

@section('plugins.BootstrapSwitch', true)
@section('plugins.BootstrapSelect', true)
@section('plugins.Summernote', true)
@section('plugins.BsCustomFileInput', true)

@section('css')
    <link rel="stylesheet" href="/assets/admin/css/admin_custom.css">
@stop

@section('js')
<script src="/assets/admin/js/app.js"></script>
<script>
    let count = 1;
    let namber = 100;

    document.getElementById('addDoc').addEventListener('click', function (e){
        e.preventDefault();
        document.getElementById('Docs').insertAdjacentHTML('beforeend', '<div class="col-sm-3"><input type="number" class="form-control mb-2"  name="doc[]"   value=""></div>');
    });


    document.getElementById('addVideo').addEventListener('click', function (e){
        e.preventDefault();
        document.getElementById('videoBlock').insertAdjacentHTML('beforeend', '<div class="col-12"><input type="text" class="form-control mb-2"  name="video[]" value=""></div>');
    });

    document.getElementById('addProperties').addEventListener('click', function (e){
        e.preventDefault();
        let tmpl = tmplProperty.content.cloneNode(true);
        tmpl.querySelector('.name').setAttribute('name', 'properties['+namber+'][name]');
        tmpl.querySelector('.value').setAttribute('name', 'properties['+namber+'][value]');
        namber++;
        document.getElementById('propertiesList').append(tmpl);
    })


    if(document.getElementById('create')){
        const img = document.getElementById('img');
        const preview = document.getElementById('preview');
        const galleryHidden = document.getElementById('galleryHidden');

   }

   async function getCоntеnt(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'POST',
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
                'Content-Type': 'application/json'
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *client
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return await response.text(); // parses JSON response into native JavaScript objects
    }

   function imgDelete(){
        let btnDelete = document.querySelectorAll('.img-del');

        btnDelete.forEach(element => {
            element.addEventListener('click', function(event){
                event.preventDefault();

                let url = event.currentTarget.getAttribute('href');
                let imgBlock =  event.currentTarget.parentNode.parentNode;
                let media = imgBlock.parentNode.getAttribute('data-media');
                let number = event.currentTarget.parentNode.getAttribute('data-number');

                getCоntеnt(url, {
                        _method: "POST",
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        media: media,
                        number: number,
                        id: {{$product->id}}
                    }) .then((data) => {
                        console.log(data);
                        if(data == 200){
                            imgBlock.remove();
                        }else{
                            alert('Sorry... Не могу удалить файл');
                        }
                    });
            });
        });
   }

   if(document.querySelectorAll('.img-del')) imgDelete();
</script>
@stop
