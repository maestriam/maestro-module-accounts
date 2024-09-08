<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\TypeFinder;

trait SearchesTypes 
{
    /**
     * Retorna a instância com as RN's sobre 
     * a pesquisa de tipo de contas.
     *
     * @return TypeFinder
     */
    public function search()
    {
        return app()->make(TypeFinder::class);
    }
}