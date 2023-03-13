@extends('adminlte::page')

@section('title', 'Создание нового товара каталога')

@section('content_header')
    <h1>Cозданияе нового товара</h1>
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



    <form role="form" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
        @csrf


    <div class="row">

        <div class="col-lg-6">

            <x-adminlte-card title="Данные товара" body-class="pb-3" collapsible removable maximizable>

                <x-adminlte-input-switch name="active" data-on-color="success" data-off-color="danger" checked/>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="main" name="main">
                        <label for="main" class="custom-control-label">Товар на главной</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="{{old('sort', 500)}}">
                    </div>
                    <label for="sort" class="col-sm-4 col-form-label">Сортировка</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="sku"  name="sku" value="{{old('sku')}}">
                    </div>
                    <label for="sku" class="col-sm-2 col-form-label">Артикул</label>
                </div>



                <x-adminlte-input name="name" label="Название товара" placeholder="Название товара" value="{{ old('name') }}" fgroup-class="col-12" enable-old-support>
                    <x-slot name="bottomSlot">
                        <span class="text-sm text-gray">Обязательно для заполенения</span>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="slug" label="URL - slug" placeholder="slug"  fgroup-class="col-12" enable-old-support/>
                <x-adminlte-select-bs name="category_id" fgroup-class="col-12" label="Выбор родительской категории">
                    <option value="">Категория товара</option>
                    @php
                        $traverse = function ($categories, $prefix = '-&ensp;') use (&$traverse) {
                            foreach ($categories as $category) {
                            echo '<option value="'.$category->id.'">'.$prefix.' '.$category->name.'</option>'.PHP_EOL;
                                $traverse($category->children, $prefix.'-&ensp;');
                            }
                        };
                        $traverse($categories);
                    @endphp
                </x-adminlte-select-bs>



                <div class="row">
                    <x-adminlte-select name="brand_id" fgroup-class="col-6" label="Бренд">
                        <option value="">Не указан</option>
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </x-adminlte-select>
                    <x-adminlte-select name="eff" fgroup-class="col-6" label="Энергоэффективность">
                        <option value="">Не указан</option>
                        <option value="A++">A+</option>
                        <option value="A+">A+</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </x-adminlte-select>
                </div>
                <div class="row">
                    <x-adminlte-input name="color" label="Цвет" placeholder="Цвет товара" value="{{ old('color') }}" fgroup-class="col-6" enable-old-support>
                    </x-adminlte-input>
                </div>

                <p class="small_title">Изображения товра</p>

                <div class="row mb-2">
                    <div class="col-6">
                        <x-adminlte-input-file name="image" igroup-size="sm" label="Основное изображение" placeholder="Основное изображение">
                            <x-slot name="image">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                    <div class="col-6">
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
                    <x-adminlte-input-file id="more" name="more[]" label="Дополнительные изображения"
                        placeholder="Choose multiple files..." igroup-size="lg" legend="Choose" multiple>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-file-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>





                <div class="row mb-2 mb-2 mt-2">
                    <div class="col-6">
                        <x-adminlte-input-file name="bg_product" igroup-size="sm" label="Фоновое изображение в шапке сайта" placeholder="Изображение">
                            <x-slot name="image">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                </div>





                <p class="small_title">Документы для товара</p>
                <div class="row">
                    <div class="col-12" id="Docs">
                        <label for="doc" class="col-sm-6 col-form-label">ID Документа</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control mb-2 @error('doc') is-invalid @enderror"  name="doc[]"   value="">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control mb-2 @error('doc') is-invalid @enderror"  name="doc[]"   value="">
                        </div>
                    </div>
                </div>
                <div class="row pt-2 mb-3">
                    <div class="col-6"><button class="btn btn-outline-secondary btn-sm" id="addDoc">Добавить</button></div>
                </div>



                <p class="small_title">Видео для товара</p>
                <div class="row">
                    <div class="col-12" id="videoBlock">
                        <label for="doc" class="col-sm-6 col-form-label">ID YouTube - ролика</label>
                        <div class="col-12">
                            <input type="text" class="form-control mb-2"  name="video[]"   value="">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control mb-2"  name="video[]"   value="">
                        </div>
                    </div>
                </div>
                <div class="row pt-2 mb-3">
                    <div class="col-6"><button class="btn btn-outline-secondary btn-sm" id="addVideo">Добавить</button></div>
                </div>
                <x-slot name="footerSlot">
                    <p></p>
                </x-slot>

            </x-adminlte-card>
        </div>
        <div class="col-lg-6">
            <x-adminlte-card title="Характерристики товара" body-class="pb-3" collapsible removable maximizable>
                <div id="propertiesList">
                @foreach ($properties as $property)
                        <div class="form-group row">
                            <div class="col-sm-6 text-lg-right">
                                <input type="text" name="properties[{{ $property->id }}][name]" value="{{$property->name}}" class="form-control">
                            </div>
                            <div class="col-sm-6 d-flex align-items-center">
                                <input type="text" name="properties[{{ $property->id }}][value]" value="{{ old('properties['.$property->id.'][value]') }}" class="form-control" placeholder="Значение...">
                            </div>
                        </div>
                @endforeach
                </div>
                <div class="row pt-3">
                    <div class="col-6"> <button class="btn btn-outline-secondary btn-sm" id="addProperties">Добавить</button> </div>
                </div>
               <template id="tmplProperty">
                   <div class="form-group row">
                       <div class="col-sm-6 text-lg-right">
                           <input type="text" name="properties[100][name]"  class="form-control name" placeholder="Название...">
                       </div>
                       <div class="col-sm-6 d-flex align-items-center">
                           <input type="text" name="properties[100][value]" class="form-control value" placeholder="Значение...">
                       </div>
                   </div>
                </template>
                <x-adminlte-textarea name="accessory" label="Аксессуары (HTML table)" fgroup-class="col-12" value="{{old('accessory')}}" enable-old-support/>
                <x-slot name="footerSlot">
                    <p></p>
                </x-slot>
            </x-adminlte-card>
        </div>

        <div class="col-lg-12">
            <x-adminlte-card title="Описание, СЕО данные товара" body-class="pb-3" collapsible removable maximizable>
                <x-adminlte-input name="h1" label="Заголовок H1 категории" fgroup-class="col-12" value="{{old('h1')}}" enable-old-support/>
                <x-adminlte-input name="meta_title" label="META - title" fgroup-class="col-12" value="{{old('meta_title')}}" enable-old-support/>
                <x-adminlte-input name="meta_keywords" label="META - keywords" fgroup-class="col-12" value="{{old('meta_keywords')}}" enable-old-support/>
                <x-adminlte-textarea name="meta_description" label="META - description" fgroup-class="col-12" value="{{old('meta_description')}}" placeholder="Insert description..." enable-old-support/>
                <h4 class="col-lg-9 mt-3 mb-2">Описание категории товаров</h4>
                <x-adminlte-text-editor name="description" fgroup-class="col-12" value="{{old('description')}}"/>
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
</script>
@stop
