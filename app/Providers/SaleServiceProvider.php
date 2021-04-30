<?php

namespace App\Providers;

use App\Http\Services\Sale\SaleService;
use App\Http\Services\Sale\SaleServiceContract;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SaleServiceProvider extends ServiceProvider implements DeferrableProvider
{
   /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SaleServiceContract::class, SaleService::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SaleServiceContract::class];
    }
}
