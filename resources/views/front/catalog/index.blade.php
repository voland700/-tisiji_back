@extends('front.layouts.layout_main')
@section('meta-title', 'TISIJI: Каталог печей и каминов  JOTUL и SCAN, товары производителя Jotul Group - официальный сайт Jotul в Армении.')
@section('meta-description', 'Каталог товаров Jotul Group - печи и камины Норвежского производителя - TISIJI - Каталог печей и каминов, официальный представитель   JOTUL в Ереване')
@section('meta-keywords', 'печи, камины, jotul, scan, скандинавские, чугунные, дровяные,  купить, цена, офоициальный, сайт, йотул, скан, армения, ереван')
@section('content')

<div class="catalog">
    <div class="catalog-wrap">
        @foreach ($categories as $category)
        <div class="catalog-list">
            <div class="catalog-list-title">
                <h3 class="catalog-list-name"><a href="{{route('front.catalog.category',  $category->slug)}}">{{$category->name}}</a></h3>
                <a href="{{route('front.content.dealer')}}" class="catalog-list-diler">Дилеры</a>
            </div>
            @if(count($category->children)>0)
            <div class="catalog-list-items">
                @foreach ($category->children as $childCategory)
                <div class="catalog-item-wrap">
                    <a href="{{ route('front.catalog.category',  $childCategory->slug) }}" class="catalog-item-img">
                        <img src="{{$childCategory->getFirstMediaUrl('category')}}" alt="{{$childCategory->name}}">
                    </a>
                    <h3 class="catalog-item-title"><a href="{{ route('front.catalog.category',  $childCategory->slug) }}">{{$childCategory->name}}</a></h3>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@include('front.layouts.info')
@endsection
