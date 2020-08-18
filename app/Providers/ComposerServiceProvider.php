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
            'ntd_layouts.search',
            'pages.rec-register',
            'nguoitimviec.apply',
            'nguoitimviec.copy-apply',
            'nguoitimviec.create-profile',
            'nguoitimviec.update-profile',
            'nhatuyendung.post-job',
            'nhatuyendung.update-job',
            'nhatuyendung.profile',
            'pages.advance-search',
        ],
        'App\Http\ViewComposers\CityListComposer');

        View::composer([         
            'nguoitimviec.apply',  
            'nguoitimviec.copy-apply',
            'nguoitimviec.create-profile',
            'nguoitimviec.update-profile',
            'nhatuyendung.post-job',
            'nhatuyendung.update-job',
            'pages.advance-search',
        ],
        'App\Http\ViewComposers\BasicComposer');
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
