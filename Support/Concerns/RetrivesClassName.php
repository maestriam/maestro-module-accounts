<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Support\Abstraction\Accountable;

trait RetrivesClassName
{
    /**
     * Retorna o nome da entidade que estende da classe Accountable. 
     *
     * @param Accountable $entity
     * @return string
     */
    public function getClassName(Accountable $entity) : string
    {
        return get_class($entity);
    }
}