<?php

namespace Maestro\Accounts\Support\Facades;

use Maestro\Accounts\Database\Factories\AccountFactory;
use Maestro\Accounts\Database\Factories\TypeFactory;

class FactoryFacade
{
    public function account() : AccountFactory
    {
        return app()->make(AccountFactory::class);
    }

    public function type() : TypeFactory
    {
        return app()->make(TypeFactory::class);
    }
}