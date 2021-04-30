<?php

namespace App\Providers;

use App\Http\Repositories\Sale\SaleRepository;
use App\Http\Repositories\Sale\SaleRepositoryContract;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SaleRepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SaleRepositoryContract::class, SaleRepository::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SaleRepositoryContract::class];
    }
}
