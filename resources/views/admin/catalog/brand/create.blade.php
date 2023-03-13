@extends('adminlte::page')

@section('title', 'Создание нового бренда товаров')

@section('content_header')
    <h1>Создание нового бренда товаров</h1>
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

    <form role="form" method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data">
        @csrf

        <x-adminlte-card title="Новый бранд" class="col-lg-6" body-class="pb-3" collapsible removable maximizable>

            <x-adminlte-input-switch name="active" data-on-color="success" data-off-color="danger" checked/>

            <div class="form-group row">
                <div class="col-sm-2">
                    <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="10">
                </div>
                <label for="sort" class="col-sm-4 col-form-label">Индекс сортировки</label>
           </div>

            <div class="row">

                <x-adminlte-input name="name" label="Название бранда" placeholder="Название бранда" fgroup-class="col-12" enable-old-support>
                    <x-slot name="bottomSlot">
                        <span class="text-sm text-gray">Обязательно для заполенения</span>
                    </x-slot>
                </x-adminlte-input>

                <p class="title_form-group col-12">Логотип бранда</p>

                <x-adminlte-input-file name="file" igroup-size="sm" placeholder="Файл - логотип">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                     </x-slot>
                </x-adminlte-input-file>
            </div>

            <x-slot name="footerSlot">
                <x-adminlte-button label="Сохранить" type="submit" class="d-flex ml-auto" theme="primary" />
            </x-slot>
        </x-adminlte-card>
    </form>
@stop

@section('plugins.BootstrapSwitch', true)
@section('plugins.BsCustomFileInput', true)

@section('css')
    <link rel="stylesheet" href="/assets/admin/css/admin_custom.css">
@stop

@section('js')

@stop
