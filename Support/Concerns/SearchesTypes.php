<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\FindTypeService;

trait SearchesTypes 
{
    /**
     * Retorna a instância com as RN's sobre 
     * a pesquisa de tipo de contas.
     *
     * @return FindTypeService
     */
    public function search()
    {
        return app()->make(FindTypeService::class);
    }
}