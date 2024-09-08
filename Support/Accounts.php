<?php

namespace Maestro\Accounts\Support;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Maestro\Accounts\Services\Foundation\AccountHandler account()
 * @method static \Maestro\Accounts\Services\Foundation\TypeHandler type()
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