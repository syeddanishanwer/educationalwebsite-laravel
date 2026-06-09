<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void 
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Corrected: Using the imported Facade class path directly
        URL::forceScheme('https');

        $vPath = '/tmp/storage/framework/views';
        if (!is_dir($vPath)) {
            mkdir($vPath, 0755, true);
        }
        config(['view.compiled' => $vPath]);
    }
}