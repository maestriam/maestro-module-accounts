<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\AccountFinder;

trait SearchesAccounts
{
    /**
     * Retorna o serviço para consulta de dados da conta
     *
     * @return AccountFinder
     */
    private function finder() : AccountFinder
    {
        return app()->make(AccountFinder::class);
    }
}
