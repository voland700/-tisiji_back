@extends('adminlte::page')

@section('title', 'Создание нового контента, стфтьи, заметки, обзора')

@section('content_header')
    <h1>Cозданияе новой статьи</h1>
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



    <form role="form" method="post" action="{{ route('article.store') }}" enctype="multipart/form-data">
        @csrf


    <div class="row">

        <div class="col-lg-6">

            <x-adminlte-card title="Данные статьи" body-class="pb-3" collapsible removable maximizable>

                <x-adminlte-input-switch name="active" data-on-color="success" data-off-color="danger" checked/>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="{{old('sort', 50)}}">
                    </div>
                    <label for="sort" class="col-sm-4 col-form-label">Сортировка</label>
                </div>
                <x-adminlte-input name="name" label="Название статьи" placeholder="Название статьи" value="{{ old('name') }}" fgroup-class="col-12" enable-old-support>
                    <x-slot name="bottomSlot">
                        <span class="text-sm text-gray">Обязательно для заполенения</span>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="slug" label="URL - slug" placeholder="slug"  fgroup-class="col-12" enable-old-support/>
                <p class="small_title">Изображения для статьи</p>

                <div class="row mb-2">
                    <div class="col-6">
                        <x-adminlte-input-file name="image" igroup-size="sm" label="Основное изображение: 940×253px" placeholder="Основное изображение">
                            <x-slot name="image">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                    <div class="col-6">
                    <x-adminlte-input-file name="prev" igroup-size="sm" label="Bзображение анонса: 308×170px" placeholder="Preview изображения">
                        <x-slot name="prev">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                    </div>
                </div>
            </x-adminlte-card>
        </div>
        <div class="col-lg-6">
            <x-adminlte-card title="Описание, СЕО данные товара" body-class="pb-3" collapsible removable maximizable>
                <x-adminlte-input name="h1" label="Заголовок H1 категории" fgroup-class="col-12" value="{{old('h1')}}" enable-old-support/>
                <x-adminlte-input name="meta_title" label="META - title" fgroup-class="col-12" value="{{old('meta_title')}}" enable-old-support/>
                <x-adminlte-input name="meta_keywords" label="META - keywords" fgroup-class="col-12" value="{{old('meta_keywords')}}" enable-old-support/>
                <x-adminlte-textarea name="meta_description" label="META - description" fgroup-class="col-12" value="{{old('meta_description')}}" placeholder="Insert description..." enable-old-support/>
                <h4 class="col-lg-9 mt-3 mb-2">Описание категории товаров</h4>
                <x-adminlte-textarea name="summary" label="Описание для анонса" fgroup-class="col-12" value="{{old('summary')}}" placeholder="Insert description..." enable-old-support/>
                <x-adminlte-text-editor name="description"  label="Детальное описание" fgroup-class="col-12" value="{{old('description')}}"/>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Сохранить" type="submit" class="d-flex ml-auto" theme="primary" />
                </x-slot>
            </x-adminlte-card>
        </div>
    </div>




    </form>
@stop

@section('plugins.BootstrapSwitch', true)
@section('plugins.Summernote', true)
@section('plugins.BsCustomFileInput', true)

@section('css')
    <link rel="stylesheet" href="/assets/admin/css/admin_custom.css">
@stop

@section('js')
<script>

/*
    document.getElementById('addProperties').addEventListener('click', function (e){
        e.preventDefault();
        let tmpl = tmplProperty.content.cloneNode(true);
        tmpl.querySelector('.name').setAttribute('name', 'properties['+namber+'][name]');
        tmpl.querySelector('.value').setAttribute('name', 'properties['+namber+'][value]');
        namber++;
        document.getElementById('propertiesList').append(tmpl);
    })


*/

</script>
@stop
