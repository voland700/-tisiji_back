@extends('adminlte::page')

@section('title', 'Доплнительная информация, статьи, обзоры, заметки')

@section('content_header')
    <h1>Спсиок cтатей</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p>{{ $message }}</p>
        </div>
    @endif

    <a href="{{route('article.create')}}" type="button" class="btn btn-primary mb-3">Добавить</a>
    <x-adminlte-card title="Бренды товаров" class="col-lg-12" collapsible removable maximizable>
        @php
            $heads = [
                ['label' => 'ID', 'width' => 2],
                'Name',
                ['label' => 'Сортировка', 'width' => 14],
                ['label' => 'Активность', 'no-export' => true, 'width' => 10],
                ['label' => 'Actions', 'no-export' => true, 'width' => 14],
            ];
            $config = [
                'order' => [[1, 'asc']],
                'columns' => [null, null, null, ['orderable' => false]],
            ];
        @endphp
        <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach($articles as $article)
            <tr>
                <td>{{$article->id}}</td>
                <td>{{$article->name}}</td>
                <td class="text-center">{{$article->sort}}</td>
                <td class="{{ $article->active === 1 ? 'green-icon' : 'pale-icon'}}"><i class="far fa-check-circle"></i></td>
                <td>
                    <a href="{{ route('article.edit', $article->id) }}" class="btn btn-xs btn-info mx-1 shadow"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                    <form method="POST" action="{{ route('article.destroy', $article->id) }}" class="formDelete">
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
<script src="/assets/admin/js/app.js"></script>
@stop
