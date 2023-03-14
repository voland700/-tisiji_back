@extends('adminlte::page')

@section('title', 'Список вопросов пользоватетей')

@section('content_header')
    <h1>Список вопросов пользователей</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p>{{ $message }}</p>
    </div>
    @endif

    <x-adminlte-card title="Вопросы с сайта" class="col-lg-12" collapsible removable maximizable>
        @php
            $heads = [
                ['label' => 'ID', 'width' => 2],
                'Name',
                ['label' => 'Дата', 'no-export' => true, 'width' => 20],
                ['label' => 'NEW', 'no-export' => true, 'width' => 10],
                ['label' => 'Actions', 'no-export' => true, 'width' => 14],
            ];
            $config = [
                'order' => [0, 'desc'],
                'columns' => [null, null, null, null, ['orderable' => false]],
            ];
        @endphp
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
        @foreach($questions as $question)
            <tr>
                <td>{{$question->id}}</td>
                <td>{{$question->name}}</td>
                <td>{{$question->created_at}}</td>
                <td class="{{ $question->new ? 'green-icon' : 'pale-icon'}}"><i class="far fa-check-circle"></i></td>
                <td>
                    <a href="{{ route('question.show', $question->id) }}" class="btn btn-xs btn-info mx-1 shadow"><i class="fa fa-lg fa-fw fa-eye"></i></a>
                    <form method="POST" action="{{ route('question.destroy', $question->id) }}" class="formDelete">
                        @csrf
                        @method('HEAD')
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
