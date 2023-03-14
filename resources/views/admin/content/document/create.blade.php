@extends('adminlte::page')

@section('title', 'Создание нового документа для товаров')

@section('content_header')
    <h1>Создание нового документа</h1>
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

    <form role="form" method="post" action="{{ route('document.store') }}" enctype="multipart/form-data">
        @csrf

        <x-adminlte-card title="Новый документ" class="col-lg-6" body-class="pb-3" collapsible removable maximizable>
            <x-adminlte-input name="name" label="Название документа" placeholder="Название документа" fgroup-class="col-12" enable-old-support>
                <x-slot name="bottomSlot">
                    <span class="text-sm text-gray">Обязательно для заполенения</span>
                </x-slot>
            </x-adminlte-input>
            <div class="row">
                <p class="title_form-group col-12">Файл документа</p>
                <x-adminlte-input-file name="file" igroup-size="sm" placeholder="Файл документа">
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
<script src="/assets/admin/js/app.js"></script>
@stop
