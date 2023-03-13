<?
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


//FRONT
Breadcrumbs::for('front.index', function ($trail) {
    $trail->push('Главная страница', route('front.index'));
});

// - CATALOG - index
Breadcrumbs::for('front.catalog.index', function (BreadcrumbTrail $trail) {
    $trail->parent('front.index');
    $trail->push('Каталог', route('front.catalog.index'));
});
// - CATALOG - categories
Breadcrumbs::for('front.catalog.category', function (BreadcrumbTrail $trail, App\Models\Category $category) {
    $trail->parent('front.index');
    $trail->push('Каталог', route('front.catalog.index'));

    foreach ($category->ancestors as $ancestor) {
        $trail->push($ancestor->name, route('front.catalog.category', $ancestor->slug));
    }
    $trail->push($category->name, route('front.catalog.category', $category));
});

// - CATALOG - product
Breadcrumbs::for('front.catalog.product', function (BreadcrumbTrail $trail, App\Models\Category $category, App\Models\Product $product) {
    $trail->parent('front.index');
    $trail->push('Каталог', route('front.catalog.index'));
    foreach ($category->ancestors as $ancestor) {
        $trail->push($ancestor->name, route('front.catalog.category', $ancestor->slug));
    }
    $trail->push($category->name, route('front.catalog.category', $category->slug));
    $trail->push($product->name, route('front.catalog.product', $product));
});

// - Articles - list
Breadcrumbs::for('front.article.list', function (BreadcrumbTrail $trail) {
    $trail->parent('front.index');
    $trail->push('Это JOTUL', route('front.article.list'));
});

// - Articles - item
Breadcrumbs::for('front.article.item', function (BreadcrumbTrail $trail, App\Models\Article $article) {
    $trail->parent('front.index');
    $trail->push('Это Jotul', route('front.article.list'));
    $trail->push($article->name, route('front.article.item', $article));
});

// - Inspiration page
Breadcrumbs::for('front.content.inspiration', function (BreadcrumbTrail $trail) {
    $trail->parent('front.index');
    $trail->push('Вдохновение', route('front.content.inspiration'));
});

// - Dealery page
Breadcrumbs::for('front.content.dealer', function (BreadcrumbTrail $trail) {
    $trail->parent('front.index');
    $trail->push('Где купить', route('front.content.dealer'));
});

// - Search page
Breadcrumbs::for('front.catalog.search', function (BreadcrumbTrail $trail) {
    $trail->parent('front.index');
    $trail->push('Поиск', route('front.catalog.search'));
});

// - Partnership page
Breadcrumbs::for('front.content.partnership', function (BreadcrumbTrail $trail) {
    $trail->parent('front.index');
    $trail->push('Сотрудничество', route('front.content.partnership'));
});

