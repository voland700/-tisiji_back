@extends('front.layouts.layout')
@section('meta-title', $product->meta_title)
@section('meta-description', $product->meta_description)
@section('meta-keywords', $product->meta_keywords)
@section('h1', $product->h1 ?? $product->name)
@section('breadcrumbs')
    {{ Breadcrumbs::render('front.catalog.product', $category, $product) }}
@endsection

@section('content')

<section class="goods_discrip-wrap">
    <div class="goods_discrip-img">

        <div class="goods_img-wrap">
            <a  href="{{$image}}">
                <img src="{{$image}}" class="goods_img" id="productImg" alt="{{$product->name}}">
            </a>
        </div>

        <div class="goods_img-prew-wrap">
            @if($product->getMedia('more')->count() > 0)

                <div class="goods_img-item">
                    <a href="{{$image}}" class="goods_img-link">
                        <img src="{{$miniature}}" alt="{{$product->name}}" class="goods_img-prev">
                    </a>
                </div>


                @foreach ($product->getMedia('more') as $key => $item)
                    <div class="goods_img-item">
                        <a href="{{$item->getUrl()}}" class="goods_img-link">
                            <img src="{{$item->getUrl('thumb')}}" alt="{{$product->name}}" class="goods_img-prev">
                        </a>
                    </div>
                @endforeach


            @endif
        </div>

    </div>
    <div class="goods_discrip-params">
            @if ($product->properties || $product->sku || $product->eff)
            <H3 class="goods_params-title">Технические характеристики</H3>
            <ul class="goods_params-list">
                @if($product->sku)
                    <li class="goods_params-item"><span class="goods_params-name">Артикул производителя: </span><span class="goods_params-value">{{ $product->sku }}</span></li>
                @endif

                @if($product->eff)
                    <li class="goods_params-item"><span class="goods_params-name">Маркировка энергоэффективности</span>
                        <span class="goods_params-value"><svg><use  xlink:href="{{$product->effectivity}}"></use></svg></span>
                    </li>
                @endif
                @if($product->color)
                    <li class="goods_params-item"><span class="goods_params-name">Цвет: </span><span class="goods_params-value">{{ $product->color }}</span></li>
                @endif
                @foreach ($product->properties as $property)
                    <li class="goods_params-item"><span class="goods_params-name">{{ $property->name }}</span><span class="goods_params-value">{{ $property->value }}</span></li>
                @endforeach
            </ul>
            @endif
    </div>

    <div class="goods_discrip-call">

        <div class="goods_info-item">
            <span class="goods_info-logo_link">
                <img src="{{$product->brand->getFirstMediaUrl('brand') }}" alt="{{$product->brand->name}}" class="goods_info-logo">
            </span>
        </div>

        <div class="goods_info-item">
            <div class="goods_info-img">
                    <svg><use  xlink:href="#phone"></use></svg>
            </div>
            <h3 class="goods_info_title">
                <span>{{ Config::get('common.phone') }}</span>
            </h3>
        </div>

        <div class="goods_info-item" style="cursor: pointer;" onclick="location.href='{{route('front.content.dealer')}}';">
                <div class="goods_info-img">
                        <svg><use  xlink:href="#wherebuy"></use></svg>
                </div>
                <h3 class="goods_info_title">
                    <a href="{{route('front.content.dealer')}}">Где купить</a>
                </h3>
        </div>

    </div>

    <div class="goods_desc">
        @if($product->description) {!! $product->description !!} @endif
        @if($product->video)
            @foreach ($product->video as $video)
                <div class="youtube">
                    <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$video}}" allowfullscreen></iframe>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    @if($product->documents->isNotEmpty() || $product->accessory )
    <h2  class="goods_doc-title">Техническая документация</h2>
    <div class="goods_doc-wrap">
        <div class="goods_doc-list">
            <H4>Инструкции, руководства, скачать:</H4>
            <ul>
                @if($product->accessory)
                <li><a href="#" data-fancybox data-src="#acsessuary"><i class="fa fa-angle-right"></i>Аксессуары для {{$product->name}}</a></li>
                @endif
                @foreach ($product->documents as $document)
                <li><a href="{{$document->getFirstMediaUrl('document')}}" target="_blank"><i class="fa fa-angle-right"></i>{{$document->name}}  <span class="goods_doc_info">{{$document->getFirstMedia('document')->human_readable_size;}}</span></a></li>
                @endforeach
            </ul>
        </div>


    </div>
    @endif
    @if($product->accessory)
        <div class="goods_acsessuary" id="acsessuary" style="display: none">{!! $product->accessory !!}</div>
    @endif
    <svg style="display: none">
		<symbol viewBox="0 0 54.67 23" id="eff-a2plas">
            <polygon points="54.67 .07 14.57 .07 14.57 0 0 11.5 14.57 23 14.57 22.93 54.67 22.93 54.67 .07" fill="#009640"/>
            <g>
              <path d="M30.5,16.73h-3.28c0-.42-.31-1.6-.93-3.54h-4.74c-.64,1.91-.96,3.09-.96,3.54h-3.09c0-.25,.8-2.27,2.39-6.06,1.6-3.79,2.39-5.88,2.39-6.27h3.88c0,.36,.72,2.42,2.17,6.18,1.45,3.76,2.17,5.81,2.17,6.15Zm-4.74-5.35c-1.17-3.26-1.75-5.02-1.75-5.28h-.16c0,.25-.61,2.01-1.82,5.28h3.73Z" fill="#fff"/>
              <path d="M40.11,12.86h-3.27v3.22h-1.85v-3.22h-3.28v-1.7h3.28v-3.22h1.85v3.22h3.27v1.7Z" fill="#fff"/>
              <path d="M50.7,12.86h-3.27v3.22h-1.85v-3.22h-3.28v-1.7h3.28v-3.22h1.85v3.22h3.27v1.7Z" fill="#fff"/>
            </g>
        </symbol>
		<symbol viewBox="0 0 54.67 23" id="eff-aplas">
            <polyline points="0 11.5 14.57 23 14.57 22.93 54.67 22.93 54.67 .07 14.57 .07 14.57 0 0 11.5" fill="#52ae32"/>
            <g>
              <path d="M30.5,16.73h-3.28c0-.42-.31-1.6-.93-3.54h-4.74c-.64,1.91-.96,3.09-.96,3.54h-3.09c0-.25,.8-2.27,2.39-6.06,1.6-3.79,2.39-5.88,2.39-6.27h3.88c0,.36,.72,2.42,2.17,6.18,1.45,3.76,2.17,5.81,2.17,6.15Zm-4.74-5.35c-1.17-3.26-1.75-5.02-1.75-5.28h-.16c0,.25-.61,2.01-1.82,5.28h3.73Z" fill="#fff"/>
              <path d="M40.11,12.86h-3.27v3.22h-1.85v-3.22h-3.28v-1.7h3.28v-3.22h1.85v3.22h3.27v1.7Z" fill="#fff"/>
            </g>
        </symbol>
		<symbol viewBox="0 0 54.67 23" id="eff-a">
            <polyline points="0 11.5 14.57 23 14.57 22.93 54.67 22.93 54.67 .07 14.57 .07 14.57 0 0 11.5" fill="#c8d400"/>
            <path d="M30.5,16.73h-3.28c0-.42-.31-1.6-.93-3.54h-4.74c-.64,1.91-.96,3.09-.96,3.54h-3.09c0-.25,.8-2.27,2.39-6.06,1.6-3.79,2.39-5.88,2.39-6.27h3.88c0,.36,.72,2.42,2.17,6.18,1.45,3.76,2.17,5.81,2.17,6.15Zm-4.74-5.35c-1.17-3.26-1.75-5.02-1.75-5.28h-.16c0,.25-.61,2.01-1.82,5.28h3.73Z" fill="#fff"/>
        </symbol>
        <symbol viewBox="0 0 54.67 23" id="eff-b">
            <polyline points="0 11.5 14.57 23 14.57 22.93 54.67 22.93 54.67 .07 14.57 .07 14.57 0 0 11.5" fill="#ffed00"/>
            <path d="M29.15,13.02c0,2.51-2.22,3.77-6.67,3.77-.77,0-1.98-.02-3.61-.06,.09-1.91,.13-4.05,.13-6.44s-.04-4.26-.13-5.88h1.66c.31,0,.84,0,1.58-.03,.74-.02,1.32-.03,1.74-.03,3.03,0,4.54,.91,4.54,2.73,0,1.4-.78,2.33-2.33,2.78v.14c.83,.12,1.55,.42,2.16,.89s.92,1.18,.92,2.12Zm-3.52-5.2c0-1.13-.77-1.69-2.3-1.69-.7,0-1.33,.05-1.88,.14,.08,.64,.11,1.73,.11,3.28,.26,.01,.53,.02,.82,.02,2.16,0,3.24-.58,3.24-1.75Zm.75,5.3c0-1.26-1.19-1.88-3.58-1.88-.47,0-.88,.02-1.22,.05,0,1.32,.03,2.53,.09,3.64,.23,.05,.58,.08,1.05,.08,1.26,0,2.19-.14,2.78-.42s.88-.77,.88-1.46Z" fill="#fff"/>
        </symbol>
        <symbol viewBox="0 0 54.67 23" id="eff-c">
            <polygon points="54.67 .07 14.57 .07 14.57 0 0 11.5 14.57 23 14.57 22.93 54.67 22.93 54.67 .07" fill="#fbba00"/>
            <path d="M28.42,14.49l-.17,2.18c-.97,.21-1.93,.32-2.87,.32-2.34,0-4.13-.6-5.36-1.79-1.23-1.2-1.84-2.65-1.84-4.36s.65-3.32,1.95-4.63c1.3-1.31,3.09-1.97,5.36-1.97,.83,0,1.62,.09,2.37,.27l-.36,2.19c-.81-.24-1.58-.36-2.32-.36-1.39,0-2.42,.41-3.1,1.22-.68,.81-1.02,1.8-1.02,2.96s.4,2.21,1.21,3.09c.8,.87,1.93,1.31,3.38,1.31,.85,0,1.77-.14,2.77-.41Z" fill="#fff"/>
        </symbol>
	</svg>
</section>
@endsection

@section('products')
@if($products)
<div class="goods_access">
    <div class="list_wrap">
        @foreach ($products as $itemProduct)
        <div class="list_item">
            <div class="list_item-img">
                <a href="{{route('front.catalog.product', $itemProduct->slug)}}" class="list_item-img-link" style="background-image: url({{ $itemProduct->getFirstMediaUrl('prev') }})"></a>
            </div>
            <h3 class="list_item-title"><a href="{{$itemProduct->slug}}">{{$itemProduct->name}}</a></h3>
            <a href="{{route('front.catalog.product', $itemProduct->slug)}}" class="list_item-btn">Смотреть продукт</a>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection
