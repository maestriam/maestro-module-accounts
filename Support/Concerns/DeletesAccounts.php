<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\AccountDestroyer;

trait DeletesAccounts
{
    /**
     * Retorna a instância com as RN's sobre 
     * a remomção de contas.
     *
     * @return AccountDestroyer
     */
    private function destroyer() : AccountDestroyer
    {
        return app()->make(AccountDestroyer::class);
    }
}
