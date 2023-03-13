@extends('front.layouts.layout_main')
@section('meta-title', 'TISIJI: печи и камины JOTUL и SCAN - официальный представитель JOTUL GROUP в Армении.')
@section('meta-description', 'Официальный сайт представителя производителей печей и каминов: Jotul и Scan  в Армении, оптовая и розничная продажа Скандинавских печей и каминов. Каталог печей и ккминов  JOTUL в Ереване')
@section('meta-keywords', 'печи, камины, jotul, scan, скандинавские, чугунные, дровяные,  купить, цена, офоициальный, сайт, йотул, скан, армения, ереван')
@section('content')
<div class="container">
    @if($products)
	<section class="mainproducts_wrap">
        @foreach ($products as $product)
        <div class="mainproducts_item">
			<a href="{{route('front.catalog.product', $product->slug)}}" class="mainproducts_item-img">
				<img src="{{$product->getFirstMediaUrl('prev')}}" alt="{{$product->name}}р">
			</a>
			<h3 class="mainproducts_title"><a href="{{route('front.catalog.product', $product->slug)}}">{{$product->name}}</a></h3>
			<a href="{{route('front.catalog.product', $product->slug)}}" class="mainproducts_btn">Посмотреть</a>
		</div>
        @endforeach
	</section>
    @endif
</div>
<section class="showcase_wrap">
	<article class="showcase_item">
		<div class="showcase_item-info">
			<div class="showcase_item-info-wrap">
				<h2 class="showcase_item-title"><a href="/catalog/product/jotul-f-3-cb-bp"> JØTUL F 3 CB BP</a></h2>
					<p class="showcase_item-txt">Jotul F 3 CB BP – современная чугунная печь чистого горения “Clesn Burn” выполненная
                        в классическом стиле обладает стильным дизайном, станет украшением Вашего загородного дома, создаст атмосферу уюта и комфорта.<br>
                        <!-- Отопительная мощность печи в диапазоне от 3,6 до 9 кВт, рассчитана на отопление загородного дома или дачи площадью до 120 м<sup>2</sup>.--></p>
					<a href="/catalog/product/jotul-f-3-cb-bp" class="showcase_item-btn">Смотреть товар</a>
			</div>
		</div>
		<div class="showcase_item-img" style="background-image: url(../images/src/products/main/block1.jpg)"></div>
	</article>

	<article class="showcase_item">
			<div class="showcase_item-info">
				<div class="showcase_item-info-wrap">
					<h2 class="showcase_item-title"><a href="/catalog/product/jotul-terrazza">JØTUL TERRAZZA</a></h2>
						<p class="showcase_item-txt">Красивый, пожаробезопасный уличный, садовый очаг Jоtul Terazza – изготовлен из прочной коррозиеустойчивой легированной стали COR-TEN – толщиной 2мм.</p>
						<a href="/catalog/product/jotul-terrazza" class="showcase_item-btn">Смотреть товар</a>
				</div>
			</div>
			<div class="showcase_item-img" style="background-image: url(../images/src/products/main/block6.jpg)"></div>
		</article>
		<article class="showcase_item">
				<div class="showcase_item-info">
					<div class="showcase_item-info-wrap">
						<h2 class="showcase_item-title"><a href="/catalog/product/jotul-i-520-frl">JØTUL I 520 CB FRL</a></h2>
							<p class="showcase_item-txt">Чугунная каминная топка Jotul I 520 FRL с фронтальным и боковыми стеклами, с функцией чистое горение “Clean Burn”,
                                обеспечивает мощность при среднем уровне горения 7 кВт, рассчитана на отопления помещений до 140 м<sup>2</sup>.</p>
							<a href="/catalog/product/jotul-i-520-frl" class="showcase_item-btn">Смотреть товар</a>
					</div>
				</div>
				<div class="showcase_item-img" style="background-image: url(../images/src/products/main/block2.jpg)"></div>
		</article>
		<article class="showcase_item">
				<div class="showcase_item-info">
					<div class="showcase_item-info-wrap">
						<h2 class="showcase_item-title"><a href="/catalog/product/jotul-f-363-bp-advance">JØTUL F 363 CB BP ADVANCE</a></h2>
							<p class="showcase_item-txt">Jotul F 363 BP Advance установленная на постаменте печь-камин в современном стиле. Используется как элемент интерьера и дополнительный
							источник отопления загородного дома или дачи. Дверка печи с большим стеклом обеспечивает превосходный вид на пламя.</p>
							<a href="/catalog/product/jotul-f-363-bp-advance" class="showcase_item-btn">Смотреть товар</a>
					</div>
				</div>
				<div class="showcase_item-img" style="background-image: url(../images/src/products/main/block5.jpg)"></div>
		</article>
</section>

<div class="container">
	<div class="showcase_video_wrap">
		<a data-fancybox="video-showcase" href="https://www.youtube.com/watch?v=yAEtxVF4rjE" class="showcase_video_link">
			<img src="./images/src/background/video_bg.jpg" class="showcase_video_bg">
			<svg class="showcase_video_icon" width="70px" height="70px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none"><path fill="red" d="M14.712 4.633a1.754 1.754 0 00-1.234-1.234C12.382 3.11 8 3.11 8 3.11s-4.382 0-5.478.289c-.6.161-1.072.634-1.234 1.234C1 5.728 1 8 1 8s0 2.283.288 3.367c.162.6.635 1.073 1.234 1.234C3.618 12.89 8 12.89 8 12.89s4.382 0 5.478-.289a1.754 1.754 0 001.234-1.234C15 10.272 15 8 15 8s0-2.272-.288-3.367z"/><path fill="#ffffff" d="M6.593 10.11l3.644-2.098-3.644-2.11v4.208z"/></svg>
		</a>
	</div>
</div>






<div class="paralax" style="background-image: url(../images/src/section-bg.jpg);">
	<div class="paralax-wrap">
		<h3>Камины JØTUL - Բուխարիներ</h3>
		<p>Чугунные камины Jotul - быстрое комфортное тепло. Мы выбираем чугун!</p>
		<a href="/catalog/category/jotul" class="paralax-btn">Чугунные печи-камины</a>
	</div>
</div>
<div class="container">
    @include('front.layouts.info')
</div>
@endsection
