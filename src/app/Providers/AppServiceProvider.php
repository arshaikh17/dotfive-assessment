<?php

namespace App\Providers;

use App\Observers\PostObserver;
use App\Post;
use App\Observers\CategoryObserver;
use App\Category;
use App\Observers\ItemObserver;
use App\Item;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        Category::observe(CategoryObserver::class);
        Item::observe(ItemObserver::class);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
