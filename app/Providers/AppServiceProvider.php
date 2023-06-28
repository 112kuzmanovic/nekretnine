<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
        view()->composer(['layouts/app','edit','welcome','jumbotron'],function(){
            view()->share('category',Category::all());
        });
        view()->composer(['home/partials/sidebar'],function(){
           
            view()->share('msg',Message::where('recipient_id',Auth::user()->id)->get());
        });
    }
}
