<?php

namespace Maestro\Accounts\Contracts;

use Maestro\Accounts\Entities\AccountEntity;

interface Facade
{
    /**
     * Retorna a entidade responsável por todas as 
     * regras de negócio sobre módulo.  
     *
     * @return AccountEntity
     */
    public function account() : AccountEntity;    
}