@extends('adminlte::page')

@section('title', 'Редактирование категории: {{ $category->name}}')

@section('content_header')
    <h1>Категориия: {{ $category->name}}</h1>
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



    <form role="form" method="post" action="{{ route('category.update', $category->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-adminlte-card title="Данные категории" class="col-lg-6" body-class="pb-3" collapsible removable maximizable>
            @php
                $config = [
                    'state' => $category->active,
                ];
            @endphp
            <x-adminlte-input-switch name="active" data-on-color="success" data-off-color="danger" :config="$config" checked/>

            <div class="form-group row">
                <div class="col-sm-2">
                    <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="{{old('sort', $category->sort)}}">
                </div>
                <label for="sort" class="col-sm-4 col-form-label">Индекс сортировки</label>
           </div>

            <div class="row">

                <x-adminlte-input name="name" label="Название категории" value="{{old('name', $category->name)}}" fgroup-class="col-12" enable-old-support>
                    <x-slot name="bottomSlot">
                        <span class="text-sm text-gray">Обязательно для заполенения</span>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="slug" label="URL - slug" value="{{$category->slug}}"  fgroup-class="col-12" enable-old-support/>

                <x-adminlte-select-bs name="parent_id" fgroup-class="col-12" label="Выбор родительской категории">
                    <option value="" @if($category->parent_id == NULL) selected @endif >Нет родительской</option>
                    @php
                        $traverse = function ($categories, $prefix = '-&ensp;', $parentId=NULL) use (&$traverse) {
                            foreach ($categories as $category) {
                                $checked = ($category->id == $parentId) ? 'selected' : '';
                                echo  '<option value="'.$category->id.'" '.$checked.'>'.$prefix.' '.$category->name.'</option>';
                                $traverse($category->children, $prefix.'-&ensp;', $parentId);
                            }
                        };
                        $traverse($categories, '-&ensp;', $category->parent_id);
                    @endphp
                </x-adminlte-select-bs>


                <div class="col-12" id="imagesBlock">
                    <p class="title_form-group">Изображение категории</p>
                    <div class="img-item-wrapper mb-2">
                        @if($media->count()>0)
                        <div class="img_item_wrap">
                            <div class="prev-img">
                                {{$media[0]}}
                                <a href="{{ route('category.img.delete', $category->id) }}" class="img-del" id="imgDelBtn" title="Удалить"><i class="fa fa-sm fa-fw fa-trash"></i></a>
                            </div>
                        </div>

                        @endif

                        <x-adminlte-input-file name="file" igroup-size="sm" fgroup-class="img-uploud"
                            placeholder="{{$media->count()>0 ? pathinfo($category->getFirstMediaUrl('category'), PATHINFO_BASENAME) : 'Нет файла'}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                </div>




                <div class="col-12" id="imagesBlock">
                    <p class="title_form-group">Изображение для категории в шапке сайта</p>
                    <div class="img-item-wrapper mb-2">
                        @if($bg_category->count()>0)
                        <div class="img_item_wrap">
                            <div class="prev-img">
                                {{$bg_category[0]}}
                                <a href="{{ route('category.background.delete', $category->id) }}" class="img-del" title="Удалить"><i class="fa fa-sm fa-fw fa-trash"></i></a>
                            </div>
                        </div>

                        @endif

                        <x-adminlte-input-file name="bg_category" igroup-size="sm" fgroup-class="img-uploud"
                            placeholder="{{$bg_category->count()>0 ? pathinfo($category->getFirstMediaUrl('bg_category'), PATHINFO_BASENAME) : 'Нет файла'}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                </div>

                <h5 class="col-lg-9 mt-3 mb-2 mt-3">СЕО данные рубрики</h5>
                <x-adminlte-input name="h1" label="Заголовок H1 категории" value="{{ old('h1', $category->h1) }}" fgroup-class="col-12" enable-old-support/>
                <x-adminlte-input name="meta_title" label="META - title" value="{{ old('meta_title', $category->meta_title) }}" fgroup-class="col-12" enable-old-support/>
                <x-adminlte-input name="meta_keywords" label="META - keywords" value="{{ old('meta_keywords', $category->meta_keywords) }}" fgroup-class="col-12" enable-old-support/>
                <x-adminlte-textarea name="meta_description" label="META - description" fgroup-class="col-12" enable-old-support>{{ old('meta_description', $category->meta_description) }}</x-adminlte-textarea>
                <h4 class="col-lg-9 mt-3 mb-2">Описание категории товаров</h4>
                <x-adminlte-text-editor name="description" fgroup-class="col-12">{!! old('description', $category->description) !!}</x-adminlte-text-editor>

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

@section('plugins.BootstrapSwitch', true)
@section('plugins.BootstrapSelect', true)
@section('plugins.Summernote', true)
@section('plugins.BsCustomFileInput', true)




@section('js')
<script>
if(document.getElementById('imagesBlock')){
	let allBtmDelete = document.querySelectorAll('.img-del');
 	if(allBtmDelete.length>0){
    allBtmDelete.forEach(function(item){
			item.addEventListener('click', deleteReqest)

		});
  }

	function deleteReqest(event){
		event.preventDefault();
        //const elem = event.currentTarget;
        let imgBlock =  event.currentTarget.parentNode;
        let labelName = event.currentTarget.parentNode.parentNode.querySelector('.custom-file-label');
        let url = event.currentTarget.getAttribute('href');
        let promise = fetch(url, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                'Content-Type': 'application/json'
                },
            })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                if(data.success == 200){
                    imgBlock.remove();
                    labelName.innerText='Нет файла';
                }else{
                    alert('Sorry... Не могу удалить файл');
                }
            });
	}
}
</script>
@stop
