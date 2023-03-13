@extends('adminlte::page')

@section('title', 'Список товаров каталога')

@section('content_header')
    @if($category_name)
    <h1>Каталог товаров, категория: {{$category_name }}</h1>
    @else
        <h1>Каталог товаров</h1>
    @endif
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p>{{ $message }}</p>
        </div>
    @endif

    <a href="{{route('product.create', $id)}}" type="button" class="btn btn-primary mb-3">Добавить</a>
    <x-adminlte-card title="Бренды товаров" class="col-lg-12" collapsible removable maximizable>
        @php
            $heads = [
                ['label' => 'ID', 'width' => 2],
                'Name',
                'Категория',
                ['label' => 'Сортировка', 'width' => 3],
                ['label' => 'На главной', 'no-export' => true, 'width' => 10],
                ['label' => 'Активность', 'no-export' => true, 'width' => 10],
                ['label' => 'Actions', 'no-export' => true, 'width' => 14],
            ];
            $config = [
                'order' => [[1, 'asc']],
                'columns' => [null, null, null, null, null, null, ['orderable' => false]],
            ];
        @endphp
        <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                @if($product->category_id)
                    <td><a href="{{route('product.list', $product->category_id)}}">{{$product->category_parent}}</a></td>
                @else
                    <td>{{$product->category_parent}}</td>
                @endif
                <td>{{ $product->sort }}</td>
                <td><span class="{{ $product->main === 1 ? 'green-icon' : 'pale-icon'}}"><i class="far fa-check-circle"></i></span></td>
                <td><span class="{{ $product->active === 1 ? 'green-icon' : 'pale-icon'}}"><i class="far fa-check-circle"></i></span></td>





                <td>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-xs btn-info mx-1 shadow"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                    <form method="POST" action="{{ route('product.destroy', $product->id) }}" class="formDelete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-danger mx-1 shadow delete" onclick="return confirm('Подтвердите удаление')"><i class="fa fa-lg fa-fw fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </x-adminlte-datatable>
    </x-adminlte-card>

@stop

@section('css')
    <link rel="stylesheet" href="/assets/admin/css/admin_custom.css">
@stop

@section('js')

@stop
