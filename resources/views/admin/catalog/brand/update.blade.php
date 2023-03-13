@extends('adminlte::page')

@section('title', 'Редактирование бранда: {{ $brand->name}}')

@section('content_header')
    <h1>Бранд: {{ $brand->name}}</h1>
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



    <form role="form" method="post" action="{{ route('brand.update', $brand->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-adminlte-card title="Данные бранда" class="col-lg-6" body-class="pb-3" collapsible removable maximizable>
            @php
                $config = [
                    'state' => $brand->active ? true : false,
                ];
            @endphp
            <x-adminlte-input-switch name="active" data-on-color="success" data-off-color="danger" :config="$config" checked/>
            <div class="form-group row">
                <div class="col-sm-2">
                    <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="{{old('sort', $brand->sort)}}">
                </div>
                <label for="sort" class="col-sm-4 col-form-label">Индекс сортировки</label>
           </div>

            <div class="row">

                <x-adminlte-input name="name" label="Название категории" value="{{old('name', $brand->name)}}" fgroup-class="col-12" enable-old-support>
                    <x-slot name="bottomSlot">
                        <span class="text-sm text-gray">Обязательно для заполенения</span>
                    </x-slot>
                </x-adminlte-input>


                <div class="col-12" id="imagesBlock">
                    <p class="title_form-group">Изображение бранда</p>
                    <div class="img-item-wrapper mb-2">
                        @if($media->count()>0)
                        <div class="prev-img">
                            {{$media[0]}}
                            <a href="{{ route('brand.img.delete', $brand->id ) }}" class="img-del" title="Удалить"><i class="fa fa-sm fa-fw fa-trash"></i></a>
                        </div>
                        @endif

                        <x-adminlte-input-file name="file" igroup-size="sm" fgroup-class="img-uploud"
                            placeholder="{{$media->count()>0 ? pathinfo($brand->getFirstMediaUrl('brand'), PATHINFO_BASENAME) : 'Нет файла'}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                </div>
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
            //body: JSON.stringify({ id: @{{ $brand->id }} })
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
