<?php

namespace Maestro\Accounts\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Maestro\Accounts\Contracts\AccountFacade account()
 * @method static \Maestro\Accounts\Contracts\Type type()
 */
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