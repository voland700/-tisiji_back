@extends('adminlte::page')

@section('title', 'Редактирование статьи {{ $article->name}}')

@section('content_header')
    <h1>Статья: {{ $article->name}}</h1>
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



    <form role="form" method="post" action="{{ route('article.update', $article->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

    <div class="row">

        <div class="col-lg-6">

            <x-adminlte-card title="Данные статьи" body-class="pb-3" collapsible removable maximizable>

                @php
                    $config = [
                        'state' => $article->active,
                     ];
                @endphp
                <x-adminlte-input-switch name="active" data-on-color="success" data-off-color="danger" :config="$config" checked/>

                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="{{old('sort', $article->sort)}}">
                    </div>
                    <label for="sort" class="col-sm-4 col-form-label">Сортировка</label>
               </div>



                <x-adminlte-input name="name" label="Название статьи" placeholder="Название статьи" value="{{ old('name', $article->name) }}" fgroup-class="col-12" enable-old-support>
                    <x-slot name="bottomSlot">
                        <span class="text-sm text-gray">Обязательно для заполенения</span>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="slug" label="URL - slug" placeholder="slug"  value="{{ old('slug', $article->slug) }}" fgroup-class="col-12" enable-old-support/>

                <p class="small_title">Изображения товра</p>

                <div class="row mb-4">
                    <div class="col-6 img_product_wrap" data-media="article">
                        @if($image->count()>0)

                        <div class="item_img_wrap">
                            <div class="item_img" data-number="0">
                                {{$image[0]}}
                                <a href="{{route('article.img.delete')}}" class="img-del" title="Удалить"><i class="fa fa-sm fa-fw fa-trash"></i></a>
                            </div>
                            <span class="item_img_name">{{ basename($image[0]->getFullUrl()).PHP_EOL; }}</span>
                        </div>

                        @endif
                        <x-adminlte-input-file name="image" igroup-size="sm" label="Основное изображение" placeholder="Основное изображение">
                            <x-slot name="image">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                    <div class="col-6 img_product_wrap" data-media="article_prev">
                        @if($prev->count()>0)

                        <div class="item_img_wrap">
                            <div class="item_img" data-number="0">
                                {{$prev[0]}}
                                <a href="{{route('article.img.delete')}}" class="img-del" title="Удалить"><i class="fa fa-sm fa-fw fa-trash"></i></a>
                            </div>
                            <span class="item_img_name">{{ basename($prev[0]->getFullUrl()).PHP_EOL; }}</span>
                        </div>

                        @endif

                        <x-adminlte-input-file name="prev" igroup-size="sm" label="Preview изображения" placeholder="Preview изображения">
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

    </div>

    <div class="row">
        <div class="col-lg-6">
            <x-adminlte-card title="Описание, СЕО данные" body-class="pb-3" collapsible removable maximizable>
                <x-adminlte-input name="h1" label="Заголовок H1 статьи" fgroup-class="col-12" value="{{ old('h1', $article->h1) }}" enable-old-support/>
                <x-adminlte-input name="meta_title" label="META - title" fgroup-class="col-12" value="{{old('meta_title', $article->meta_title)}}" enable-old-support/>
                <x-adminlte-input name="meta_keywords" label="META - keywords" fgroup-class="col-12" value="{{old('meta_keywords', $article->meta_keywords)}}" enable-old-support/>
                <x-adminlte-textarea name="meta_description" label="META - description" fgroup-class="col-12"  enable-old-support>{{old('meta_description', $article->meta_description)}}</x-adminlte-textarea>
                <h4 class="col-lg-9 mt-3 mb-2">Описание статьи</h4>


                <x-adminlte-textarea name="summary" label="Описание для анонса" fgroup-class="col-12" enable-old-support>{{old('summary', $article->summary)}}</x-adminlte-textarea>
                <x-adminlte-text-editor name="description" fgroup-class="col-12">{{old('description', $article->description)}}</x-adminlte-textarea>
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
<script src="/assets/admin/js/app.js"></script>
<script>
   async function getCоntеnt(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'POST',
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
                'Content-Type': 'application/json'
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *client
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return await response.text(); // parses JSON response into native JavaScript objects
    }

   function imgDelete(){
        let btnDelete = document.querySelectorAll('.img-del');

        btnDelete.forEach(element => {
            element.addEventListener('click', function(event){
                event.preventDefault();

                let url = event.currentTarget.getAttribute('href');
                let imgBlock =  event.currentTarget.parentNode.parentNode;
                let media = imgBlock.parentNode.getAttribute('data-media');
                let number = event.currentTarget.parentNode.getAttribute('data-number');

                getCоntеnt(url, {
                        _method: "POST",
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        media: media,
                        number: number,
                        id: {{$article->id}}
                    }) .then((data) => {
                        console.log(data);
                        if(data == 200){
                            imgBlock.remove();
                        }else{
                            alert('Sorry... Не могу удалить файл');
                        }
                    });
            });
        });
   }

   if(document.querySelectorAll('.img-del')) imgDelete();

</script>
@stop
