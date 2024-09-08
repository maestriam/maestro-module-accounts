<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\FindAccountService;

trait SearchesAccounts
{
    /**
     * Retorna o serviço para consulta de dados da conta
     *
     * @return FindAccountService
     */
    private function finder() : FindAccountService
    {
        return app()->make(FindAccountService::class);
    }
}
