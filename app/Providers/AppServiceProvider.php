<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // Reroute compiled Blade templates to the writable /tmp directory on Vercel
        if (env('VERCEL_JOB_ID') || env('NOW_REGION')) {
            $vPath = '/tmp/storage/framework/views';
            
            if (!is_dir($vPath)) {
                mkdir($vPath, 0755, true);
            }
            
            config(['view.compiled' => $vPath]);
        }
    }
}