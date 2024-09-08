<?php

namespace Maestro\Accounts\Support\Facades;

use Maestro\Accounts\Support\Concerns\HandlesTypes;
use Maestro\Accounts\Support\Concerns\HandlesAccounts;
use Maestro\Accounts\Support\Facades\FactoryFacade;

class ModuleFacade
{   
    use HandlesAccounts, HandlesTypes;

    /**
     * Retorna o objeto para criação de dados fictícios de conta
     * e tipo de conta. 
     *
     * @return FactoryFacade
     */
    public function factory() : FactoryFacade
    {
        return app()->make(FactoryFacade::class);
    }
}