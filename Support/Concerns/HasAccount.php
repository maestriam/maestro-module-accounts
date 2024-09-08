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
     * Define o nome da conta de uma entidade ou retorna os dados da
     * conta. 
     *
     * @param string|null $name
     * @return self|Account
     */
    public function account() : ?Account
    {
        return $this->getAccount();
    }

    /**
     * Retorna todos os dados da conta
     *
     * @return Account|null
     */
    private function getAccount() : ?Account
    {
        $search = app(AccountFinder::class);

        return $search->info($this);
    }
}
