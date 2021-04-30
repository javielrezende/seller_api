<?php

namespace App\Providers;

use App\Http\Repositories\Seller\SellerRepository;
use App\Http\Repositories\Seller\SellerRepositoryContract;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SellerRepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SellerRepositoryContract::class, SellerRepository::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SellerRepositoryContract::class];
    }
}
