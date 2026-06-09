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
        // Your Solution: Force modern, secure HTTPS asset links when running on Vercel
        if (isset($_SERVER['HTTPS']) || isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            URL::forceScheme('https');
        }

        // Configure the writable /tmp path for compiled theme views on Vercel
        if (env('VERCEL_JOB_ID') || env('NOW_REGION')) {
            $vPath = '/tmp/storage/framework/views';
            
            if (!is_dir($vPath)) {
                mkdir($vPath, 0755, true);
            }
            
            config(['view.compiled' => $vPath]);
        }
    }
}