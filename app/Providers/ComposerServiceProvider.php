<?php

namespace App\Providers;

use App\Models\Blog;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer(['partials.meta_dynamic', 'layouts.nav', 'admin.index'], function($view) {
            $view->with('blogs', Blog::all());
        });
    }
}
