@extends('front.layouts.layout')
@section('meta-title', 'TISIJI: партнер Jotul Group в Армении, информация о продукции Jotul, статьи и рекомендации')
@section('meta-description', 'Печи и камины - продукция Jotul Group, особенности использования, рекомендации, полезная информация для пользователей JOTUL')
@section('meta-keywords', 'печи, камины, jotul, scan, скандинавские, чугунные, дровяные,  купить, цена, офоициальный, сайт, йотул, скан, армения, ереван')
@section('h1', 'Это JOTUL');

@section('breadcrumbs')
    {{ Breadcrumbs::render('front.article.list') }}
@endsection

@section('content')
    @if(!$articles->isEmpty())
    <div class="article-wrap">
        @foreach($articles as $article)
            <div class="article-list-item" onclick="location.href='{{route('front.article.item', $article->slug)}}';">
                <a href="{{route('front.article.item',$article->slug)}}" class="article-list-img">
                    <img src="{{$article->getFirstMediaUrl('article_prev')}}" alt="{{$article->name}}">
                </a>
                <h3 class="article-list-title"><a href="{{route('front.article.item',$article->slug)}}">{{$article->name}}</a></h3>
                <p>{{ $article->preview}}</p>
            </div>
        @endforeach
    </div>
    @endif
    {{$articles->onEachSide(2)->links('front.layouts.pagination')}}
    @include('front.layouts.info')
@endsection
