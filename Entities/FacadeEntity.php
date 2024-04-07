<?php

namespace Maestro\Accounts\Entities;

/**
 * @method static bool belongsTo()
 */
class FacadeEntity
{   
    public function account() : AccountEntity
    {
        return new AccountEntity();
    }

    public function type(string|object $entity = null) : TypeEntity
    {
        return new TypeEntity($entity);
    }
}