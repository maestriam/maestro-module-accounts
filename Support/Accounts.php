<?php

namespace Maestro\Accounts\Support;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Maestro\Accounts\Support\Facades\TypeFacade type()
 * @method static \Maestro\Accounts\Support\Facades\AccountFacade account()
 * @method static \Maestro\Accounts\Support\Facades\FactoryFacade factory()
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