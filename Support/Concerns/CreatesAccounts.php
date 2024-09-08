<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\AccountCreator;

trait CreatesAccounts
{
    /**
     * Retorna o serviço para persistência de dados da conta
     *
     * @return AccountCreator
     */
    public function creator() : AccountCreator
    {
        return app()->make(AccountCreator::class);
    }
}
