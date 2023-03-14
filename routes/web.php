<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\Catalog\CategoryController;
use App\Http\Controllers\Admin\Catalog\BrandController;
use App\Http\Controllers\Admin\Catalog\DocumentController;
use App\Http\Controllers\Admin\Catalog\PropertyController;
use App\Http\Controllers\Admin\Catalog\ProductController;
use App\Http\Controllers\Admin\Content\ArticleController;
use App\Http\Controllers\Admin\Catalog\ImportController;
use App\Http\Controllers\Admin\Content\QuestionController;

use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\CatalogController;
use App\Http\Controllers\Front\ArticleFrontController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [IndexController::class, 'index'])->name('front.index');

Route::get('/catalog', [CatalogController::class, 'index'])->name('front.catalog.index');
Route::get('/catalog/category/{slug}', [CatalogController::class, 'category'])->name('front.catalog.category');
Route::get('/catalog/product/{slug}', [CatalogController::class, 'product'])->name('front.catalog.product');

Route::get('/article/list', [ArticleFrontController::class, 'list'])->name('front.article.list');
Route::get('/article/item/{slug}', [ArticleFrontController::class, 'item'])->name('front.article.item');

Route::get('/search', [CatalogController::class, 'search'])->name('front.catalog.search');

Route::get('/inspiration', function () {
    return view('front.content.inspiration');
})->name('front.content.inspiration');


Route::get('/dealer', function () {
       return view('front.content.dealer');
})->name('front.content.dealer');

Route::get('/partnership', function () {
    return view('front.content.partnership');
})->name('front.content.partnership');

Route::post('/make-a-question', [QuestionController::class, 'make'])->name('front.question.make');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', [MainController::class, 'index'])->name('admin.main');
    Route::get('/cache-clear', [MainController::class, 'cacheClear'])->name('cache.clear');

    Route::resource('category', CategoryController::class);
    Route::get('/category-img-delete/{id}', [CategoryController::class, 'imgDelete'])->name('category.img.delete');
    Route::get('/category-background-delete/{id}', [CategoryController::class, 'bacgroundDelete'])->name('category.background.delete');

    Route::resource('brand', BrandController::class);
    Route::get('/brand-img-delete/{id}', [BrandController::class, 'imgDelete'])->name('brand.img.delete');
    Route::resource('document', DocumentController::class);
    Route::get('/document-file-delete/{id}', [DocumentController::class, 'fileDelete'])->name('document.file.delete');
    Route::resource('property', PropertyController::class);

    Route::get('/product-list/{id?}', [ProductController::class, 'list'])->name('product.list');
    Route::get('/product-create/{id?}', [ProductController::class, 'create'])->name('product.create');

    Route::post('/product-img-delete', [ProductController::class, 'img_delete'])->name('product.img.delete');
    Route::resource('product', ProductController::class);

    Route::resource('article', ArticleController::class);
    Route::post('/article-img-delete', [ArticleController::class, 'img_delete'])->name('article.img.delete');

    Route::get('/import-show', [ImportController::class, 'showUploadForm'])->name('import.show');
    Route::post('/import-uploud',[ImportController::class, 'UploadData'])->name('import.uploud');

    Route::get('/import-docs-show', [ImportController::class, 'showDocumentUploadForm'])->name('import.document.show');
    Route::post('/import-docs-uploud',[ImportController::class, 'documentUploadData'])->name('import.document.uploud');

    Route::get('/import-background-show', [ImportController::class, 'showBackgroundUploadForm'])->name('import.background.show');
    Route::post('/import-background-uploud',[ImportController::class, 'backgroundUploadData'])->name('import.background.uploud');

    Route::get('/questions-list', [QuestionController::class, 'index'])->name('questions.list');
    Route::get('/question-show/{id}', [QuestionController::class, 'show'])->name('question.show');
    Route::get('/question-destroy/{id}', [QuestionController::class, 'destroy'])->name('question.destroy');
 });

Route::get('/test', [CategoryController::class, 'test']);


?>
