<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer([
            'layouts.search',
            'pages.rec-register',
            'nguoitimviec.apply',
            'nguoitimviec.create-profile',
            'nguoitimviec.update-profile',
            'nhatuyendung.post-job',
            'nhatuyendung.update-job',
            'nhatuyendung.profile',
        ],
        'App\Http\ViewComposers\CityListComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //      
    }
}
