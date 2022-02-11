<?php

namespace App\Providers;
use App;
use App\Advert;
use App\Comment;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Brand;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //$popular_brands = Brand::select('id','logo','brand')->orderBy('brand', 'asc')->get();
        //View::share('popular_brands',$popular_brands);
        Blade::component('components.sort', 'sort');
        Blade::component('components.sort_comment', 'comment_sort');
        Schema::defaultStringLength(191);

        $newest_adverts = Advert::orderBy('created_at','desc')->take(3)->get();
        $newest_comments = Comment::orderBy('created_at','desc')->take(3)->get();
        View::share('newest_adverts',$newest_adverts);
        View::share('newest_comments',$newest_comments);


        Relation::morphMap([
            'advert' => 'App\Advert',
            'article' => 'App\Article',
            'forum' => 'App\Forum',
        ]);
    }
}
