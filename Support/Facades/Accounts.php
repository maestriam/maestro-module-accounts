<?php

namespace Maestro\Accounts\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Accounts extends Facade
{
    /**
     * Registra o nome do Facade.
     *
     * @return string
     */
    protected static function getFacadeAccessor() 
    { 
        return 'accounts'; 
    }    
}