<?php

namespace Maestro\Accounts\Support\Contracts;

use Maestro\Accounts\Entities\Account;

interface Accountable
{
    /**
     * Retorna o nome da entidade que possui uma conta.  
     *
     * @return string
     */
    public function name() : string;

    /**
     * Retorna as informações da conta da entidade. 
     *
     * @return Account|null
     */
    public function account() : ?Account;
}