<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Support\Facades\AccountFacade;

trait HandlesAccounts
{
    public function account() : AccountFacade
    {
        return app()->make(AccountFacade::class);
    }
}
