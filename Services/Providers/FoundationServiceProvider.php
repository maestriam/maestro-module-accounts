<?php

namespace Maestro\Accounts\Services\Providers;

use Illuminate\Support\ServiceProvider;
use Maestro\Accounts\Services\Foundation\AccountCreator;
use Maestro\Accounts\Services\Foundation\RelationHandler;

class FoundationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerFoundations();
    }

    private function registerFoundations()
    {
        // $this->app->singleton(FindTypeService::class);
        // $this->app->singleton(FindAccountService::class);
        // $this->app->singleton(StoreTypeService::class);
        $this->app->singleton(AccountCreator::class);
        $this->app->singleton(RelationHandler::class);
    }    
}