@extends('front.layouts.layout')
@section('meta-title', $article->meta_title)
@section('meta-description', $article->meta_description)
@section('meta-keywords', $article->meta_keywords)
@section('h1', $article->h1 ?? $article->name)
@section('breadcrumbs')
    {{ Breadcrumbs::render('front.article.item', $article) }}
@endsection
@section('content')
<div class="article-one-wrap">
    <div class="article-menu">
        @if(!$list->isEmpty())
        <h3 class="article-menu-title">ABOUT JØTUL</h3>
        <ul class="article-menu-list">
            @foreach($list as $menuItem)
                @if ($menuItem->slug == $article->slug)
                <li><span class="article-menu-link active"><i class="fa fa-angle-right"></i>{{$menuItem->name}}</span></li>
                @else
                <li><a href="{{route('front.article.item', $menuItem->slug)}}" class="article-menu-link"><i class="fa fa-angle-right"></i>{{$menuItem->name}}</a></li>
                @endif
            @endforeach
        </ul>
        @endif
    </div>
    <div class="article-content">
        @if($article->getMedia('article')->count())
        <img src="{{$article->getFirstMediaUrl('article')}}" alt="{{ $article->name }}" class="img-center-100">
        @endif
        {!! $article->description !!}
    </div>
</div>
@endsection
