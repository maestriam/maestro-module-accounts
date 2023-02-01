<?php

namespace Maestro\Accounts\Services\Foundation;

use Maestro\Accounts\Database\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreTypeService
{
    /**
     * Salva as informações de um tipo de conta
     *
     * @param Type $type
     * @param string|object $entity
     * @param boolean $auth
     * @return Type
     */
    public function save(Type $type, string|object $entity, bool $auth) : Type
    {   
        $name = $this->getName($entity);

        $type->auth = $auth;       
        $type->name = $name;

        $type->save();

        return $type;
    }

    /**
     * Retorna um factory de tipo de conta
     *
     * @return Factory
     */
    public function factory() : Factory
    {
        return Type::factory();
    }

    /**
     * Extrai um nome para um tipo de conta através de uma classe ou uma string.  
     *
     * @param string|object $type
     * @return string
     */
    public function getName(string|object $type) : string
    {
        return (is_string($type)) ? $type : get_class($type);
    }    
}