<?php

namespace Maestro\Accounts\Services\Foundation;

use Maestro\Accounts\Entities\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use Maestro\Accounts\Exceptions\TypeExistsException;
use Maestro\Accounts\Support\Concerns\SearchesTypes;

class TypeCreator
{
    use SearchesTypes;

    /**
     * {@inheritDoc}
     */
    public function create(string|object $name, bool $auth = false) : Type 
    {        
        if ($this->search()->find($name)) {
            throw new TypeExistsException($name);
        }

        $type = new Type();

        return $this->save($type, $name, $auth);
    }

    /**
     * {@inheritDoc}
     */
    public function findOrCreate(string|object $name, bool $auth = false) : Type
    {
        $type = $this->search()->find($name);

        return (! $type) ? $this->create($name, $auth) : $type;
    }

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
        
        $type->auth  = $auth;       
        $type->name  = $name;
        $type->token = $this->getToken($entity);

        $type->save();

        return $type;
    }

    private function getToken(string|object $entity) : string
    {
        return match(true) {
            is_object($entity) => $entity->token(),
            is_string($entity) => sha1($entity),
        };
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
     * Extrai um nome para um tipo de conta 
     * através de uma classe ou uma string.  
     *
     * @param string|object $type
     * @return string
     */
    public function getName(string|object $type) : string
    {
        return (is_string($type)) ? $type : get_class($type);
    }    
}