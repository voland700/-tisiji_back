@extends('front.layouts.layout')
@section('meta-title', $s.' - результаты поиска по каталогу')
@section('meta-description', $s.' - поисковый запрос, вывод результатов поиска по каталогу сайта')
@section('meta-keywords', $s.', поиск, сайт, магазин, запрос, ')
@section('h1', 'Поиск по запросу: '.$s)

@section('breadcrumbs')
    {{ Breadcrumbs::render('front.catalog.search') }}
@endsection

@section('content')

        <div class="list_wrap">
        @forelse ($products as $product)
            <div class="list_item">
                <div class="list_item-img">
                    <a href="{{route('front.catalog.product', $product->slug)}}" class="list_item-img-link" style="background-image: url({{$product->getFirstMediaUrl('prev')}})">{{$product->name}}</a>
                </div>
                <h3 class="list_item-title"><a href="{{route('front.catalog.product', $product->slug)}}">{{$product->name}}</a></h3>
                <a href="{{route('front.catalog.product', $product->slug)}}" class="list_item-btn">Смотреть продукт</a>
            </div>
        @empty
            <div style="min-height: 25vh">
                <h3>По запросу {{$s}} товаров нет.</h3>
            </div>
        @endforelse
        </div>
        {{$products->links('front.layouts.pagination')}}
@endsection
