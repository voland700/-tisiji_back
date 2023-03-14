@extends('adminlte::page')

@section('title', 'Импорт данных, добавление файлов фоновых изображений  существующим товарам' )

@section('content_header')
    <h1>Добавление изображений к товарам</h1>
@stop

@section('content')

    <div class="col-md-9">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        @if (session()->has('failures'))

            <table class="table table-danger">
                <tr>
                    <th>Row</th>
                    <th>Attribute</th>
                    <th>Errors</th>
                    <th>Value</th>
                </tr>

                @foreach (session()->get('failures') as $validation)
                    <tr>
                        <td>{{ $validation->row() }}</td>
                        <td>{{ $validation->attribute() }}</td>
                        <td>
                            <ul>
                                @foreach ($validation->errors() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            {{ $validation->values()[$validation->attribute()] }}
                        </td>
                    </tr>
                @endforeach
            </table>

        @endif

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info mr-2"></i>Внимание!</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Важная информация для Импорта данных</p>
                        <p>Добавление фоновых изображений в шапке сайта на странице товара. Файлы добавляются в существующим товарм по ID</p>
                        <h5>Поля для импорта в EXCEL - файле</h5>
                        <ul>
                            <li><b>id</b> - id тоавра, Product - модели</li>
                            <li><b>file</b> - путь к загружаемому файлу</li>
                        </ul>
                    </div>
                    <div class="card-footer"><p></p></div>
                </div>
            </div>


        <div class="card">
            <div class="card-header">
                <p></p>
            </div>
            <div class="card-body">
                <form action="{{route('import.background.uploud')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file">Загрузиить файл</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file" name="file" value="{{old('file')}}">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <button type="submit" class="btn btn-primary align-self-end mb-3">Import</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <p></p>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/assets/admin/css/admin_custom.css">
@stop

@section('js')
    <script src="/assets/admin/js/app.js"></script>
@stop
