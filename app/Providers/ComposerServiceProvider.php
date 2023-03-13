<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use App\Http\Helpers\Background;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('front.layouts.footer', function($view) {
            $view->with(['menuitems' => Category::where([['parent_id', NULL],['active', 1]])->select('id', 'name', 'slug')->orderBy('sort')->get()]);

        });
        View::composer('front.layouts.header', function($view) {
            $view->with(['background' => Background::getImage()]);
        });
    }
}
