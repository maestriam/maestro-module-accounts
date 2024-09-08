<?php

namespace Maestro\Accounts\Services\Contracts;

use Maestro\Accounts\Entities\Account;

interface AccountCreatorContract
{
    /**
     * Registra o nome da conta da entidade, de acordo com o tipo específico.  
     *
     * @param Account $account
     * @param object $entity
     * @param string $type
     * @return Account
     */
    public function create(object $entity, string $name, string $type = null) : Account;
}