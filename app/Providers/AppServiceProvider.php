<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\BasicSetting as BS;
use App\Social;
use App\Ulink;
use App\Page;
use App\Scategory;
use App\Language;

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
      $bs = BS::first();
      $socials = Social::all();
      $pages = Page::all();
      $ulinks = Ulink::all();
      $scats = Scategory::all();
      $langs = Language::all();


      View::share('bs', $bs);
      View::share('socials', $socials);
      View::share('scats', $scats);
      View::share('pages', $pages);
      View::share('ulinks', $ulinks);
      View::share('langs', $langs);
    }
}
