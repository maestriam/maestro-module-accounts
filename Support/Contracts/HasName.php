<?php

namespace Maestro\Accounts\Support\Contracts;

interface HasName
{
    /**
     * Retorna o nome da entidade que possui uma conta.  
     *
     * @return string
     */
    public function name() : string;
}