@extends('adminlte::page')

@section('title', 'Вопросо пользователя')

@section('content_header')
    <h1>Вопросов пользователя: {{ $question->name }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Данные пользователя</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                      <tr>
                        <td>Имя пользователя:</td>
                        <td>{{ $question->name }}</td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td>{{ $question->email }}</td>
                      </tr>
                      <tr>
                        <td>Дата:</td>
                        <td>{{$question->created_at}}</td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>Вопрос:</strong></td>
                      </tr>
                      <tr>
                        <td colspan="2">{{ $question->text }}</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
            <div class="card-footer">
               <p></p>
            </div>
        </div>
    </div>
</div>



@stop

@section('css')
    <link rel="stylesheet" href="/assets/admin/css/admin_custom.css">
@stop

@section('js')

@stop
