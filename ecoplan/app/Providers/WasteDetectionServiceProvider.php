<?php

namespace App\Providers;

use App\Services\WasteDetectionService;
use Illuminate\Support\ServiceProvider;

class WasteDetectionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(WasteDetectionService::class, function ($app) {
            return new WasteDetectionService(config('waste-detection.api_url'));
        });
    }
}
