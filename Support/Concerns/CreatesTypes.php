<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\TypeCreator;

trait CreatesTypes
{
    /**
     * Retorna a instância com as RN's sobre 
     * a persistência de tipo de contas.
     *
     * @return TypeCreator
     */
    public function creator() : TypeCreator
    {
        return app()->make(TypeCreator::class);
    }
}
