@extends('adminlte::page')

@section('title', 'Редактирование характеристики: {{ $property->name}}')

@section('content_header')
    <h1>Характеристика: {{ $property->name}}</h1>
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



    <form role="form" method="post" action="{{ route('property.update', $property->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-adminlte-card title="Данные бранда" class="col-lg-6" body-class="pb-3" collapsible removable maximizable>

            <div class="form-group row">
                <div class="col-sm-2">
                    <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="{{old('sort', $property->sort)}}">
                </div>
                <label for="sort" class="col-sm-4 col-form-label">Индекс сортировки</label>
           </div>

            <div class="row">
                <x-adminlte-input name="name" label="Название характеристики" value="{{old('name', $property->name)}}" fgroup-class="col-12" enable-old-support>
                    <x-slot name="bottomSlot">
                        <span class="text-sm text-gray">Обязательно для заполенения</span>
                    </x-slot>
                </x-adminlte-input>
            </div>

           <x-slot name="footerSlot">
                <x-adminlte-button label="Сохранить" type="submit" class="d-flex ml-auto" theme="primary" />
            </x-slot>
        </x-adminlte-card>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/assets/admin/css/admin_custom.css">
@stop

@section('js')
<script src="/assets/admin/js/app.js"></script>
@stop
