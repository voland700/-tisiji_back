@extends('adminlte::page')

@section('title', 'Создание новой категории')

@section('content_header')
    <h1>Cозданияе новой категории</h1>
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



    <form role="form" method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
        @csrf

        <x-adminlte-card title="Новая категория" class="col-lg-6" body-class="pb-3" collapsible removable maximizable>

            <x-adminlte-input-switch name="active" data-on-color="success" data-off-color="danger" checked/>

            <div class="form-group row">
                <div class="col-sm-2">
                    <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="50">
                </div>
                <label for="sort" class="col-sm-4 col-form-label">Индекс сортировки</label>
           </div>

            <div class="row">

                <x-adminlte-input name="name" label="Название категории" placeholder="Название категории" fgroup-class="col-12" enable-old-support>
                    <x-slot name="bottomSlot">
                        <span class="text-sm text-gray">Обязательно для заполенения</span>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="slug" label="URL - slug" placeholder="slug"  fgroup-class="col-12" enable-old-support/>

                <x-adminlte-select-bs name="parent_id" fgroup-class="col-12" label="Выбор родительской категории">
                    <option value="">Нет родительской</option>
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
                    <div class="col-lg-12">
                        <x-adminlte-input-file name="file" igroup-size="sm" fgroup-class="mb-4" placeholder="Файл изображения">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>

                        <x-adminlte-input-file name="bg_category" igroup-size="sm" placeholder="Файл Background">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                </div>

                <h4 class="col-lg-9 mt-3 mb-2">СЕО данные рубрики</h4>
                <x-adminlte-input name="h1" label="Заголовок H1 категории" fgroup-class="col-12" enable-old-support/>
                <x-adminlte-input name="meta_title" label="META - title" fgroup-class="col-12" enable-old-support/>
                <x-adminlte-input name="meta_keywords" label="META - keywords" fgroup-class="col-12" enable-old-support/>
                <x-adminlte-textarea name="meta_description" label="META - description" fgroup-class="col-12" placeholder="Insert description..." enable-old-support/>
                <h4 class="col-lg-9 mt-3 mb-2">Описание категории товаров</h4>
                <x-adminlte-text-editor name="description" fgroup-class="col-12"/>

            </div>

            <x-slot name="footerSlot">
                <x-adminlte-button label="Сохранить" type="submit" class="d-flex ml-auto" theme="primary" />
            </x-slot>
        </x-adminlte-card>
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

@stop
