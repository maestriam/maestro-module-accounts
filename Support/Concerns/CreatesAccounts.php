<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\StoreAccountService;

trait CreatesAccounts
{
    /**
     * Retorna o serviço para persistência de dados da conta
     *
     * @return StoreAccountService
     */
    public function creator() : StoreAccountService
    {
        return app()->make(StoreAccountService::class);
    }
}
