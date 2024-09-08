<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\AccountHandler;

trait HandlesAccounts
{
    public function account() : AccountHandler
    {
        return app()->make(AccountHandler::class);
    }
}
