<?php

namespace App\Providers;

use App\Http\Services\Seller\SellerService;
use App\Http\Services\Seller\SellerServiceContract;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SellerServiceProvider extends ServiceProvider implements DeferrableProvider
{
   /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SellerServiceContract::class, SellerService::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SellerServiceContract::class];
    }
}
