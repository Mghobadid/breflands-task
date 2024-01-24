<?php

namespace App\Providers;

use App\Compression\Interface\CompressionStrategy;
use App\Compression\ZipCompression;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CompressionStrategy::class,config('compressor.strategies')[config('compressor.strategy')]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
