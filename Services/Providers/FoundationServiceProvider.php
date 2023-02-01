<?php

namespace Maestro\Accounts\Services\Providers;

use Illuminate\Support\ServiceProvider;
use Maestro\Accounts\Services\Foundation\FindAccountService;
use Maestro\Accounts\Services\Foundation\StoreTypeService;
use Maestro\Accounts\Services\Foundation\FindTypeService;
use Maestro\Accounts\Services\Foundation\RelateAccountsService;
use Maestro\Accounts\Services\Foundation\StoreAccountService;

class FoundationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerFoundations();
    }

    private function registerFoundations()
    {
        $this->app->singleton(FindTypeService::class);
        $this->app->singleton(FindAccountService::class);
        $this->app->singleton(StoreTypeService::class);
        $this->app->singleton(StoreAccountService::class);
        $this->app->singleton(RelateAccountsService::class);
    }    
}