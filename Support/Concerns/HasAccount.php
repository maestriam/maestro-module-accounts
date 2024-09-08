<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Services\Foundation\AccountFinder;

/**
 * Fornece a classe funcionalidades para criação de conta
 */
trait HasAccount
{
    /**
     * Retorna as informações da conta da entidade. 
     *
     * @return Account|null
     */
    public function account() : ?Account
    {
        $search = app(AccountFinder::class);

        return $search->info($this);
    }
}
