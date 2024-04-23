<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\FindAccountService;

trait SearchesAccount
{
    public function accountFinder() : FindAccountService
    {
        return app()->make(FindAccountService::class);
    }
}