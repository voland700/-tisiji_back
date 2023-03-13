@extends('front.layouts.layout')
@section('meta-title',  $category->meta_title)
@section('meta-description', $category->meta_description)
@section('meta-keywords', $category->meta_keywords)
@section('h1', $category->h1 ?? $category->name)

@section('breadcrumbs')
    {{ Breadcrumbs::render('front.catalog.category', $category) }}
@endsection

@section('content')
    @if(!$categories->isEmpty())
    <div class="list_wrap">
        @foreach($categories as $category)
        <div class="catalog-section-item">
            <div class="catalog-section-img">
                <a href="{{route('front.catalog.category', $category->slug)}}" class="catalog-section-link">
                    <img src="{{$category->getFirstMediaUrl('category')}}" alt="{{$category->name}}">
                </a>
            </div>
            <h3 class="catalog-section-title"><a href="{{route('front.catalog.category', $category->slug)}}">{{$category->name}}</a></h3>
        </div>
        @endforeach
    </div>
    @endif

    @if(!$products->isEmpty())
        <div class="list_wrap">
            @foreach($products as $product)
            <div class="list_item">
                <div class="list_item-img">
                    <a href="{{route('front.catalog.product', $product->slug)}}" class="list_item-img-link" style="background-image: url({{$product->getFirstMediaUrl('prev')}})">{{$product->name}}</a>
                </div>
                <h3 class="list_item-title"><a href="{{route('front.catalog.product', $product->slug)}}">{{$product->name}}</a></h3>
                <a href="{{route('front.catalog.product', $product->slug)}}" class="list_item-btn">Смотреть продукт</a>
            </div>
            @endforeach
        </div>
    @endif
    {{$products->onEachSide(2)->links('front.layouts.pagination')}}
    @if ($category->description)
    <div class="list_discription">{!! $category->description !!}</div>
    @endif
@endsection

