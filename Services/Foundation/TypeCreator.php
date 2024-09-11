<?php

namespace Maestro\Accounts\Services\Foundation;

use Maestro\Accounts\Entities\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use maestro\Accounts\Exceptions\TokenNotFoundException;
use Maestro\Accounts\Exceptions\TypeExistsException;
use Maestro\Accounts\Support\Abstraction\Accountable;
use Maestro\Accounts\Support\Concerns\RetrievesClassName;
use Maestro\Accounts\Support\Concerns\SearchesTypes;

class TypeCreator
{
    use SearchesTypes, 
        RetrievesClassName;

    /**
     * Executa a criação de um novo tipo de conta, de acordo com um objeto
     * Accoutable específico.  
     * Somente é possível criar apenas um tipo com o mesmo token e mesma classe.    
     * Caso contrário, uma exception deve ser disparada. 
     * 
     * @param Accountable $entity
     * @param boolean $auth
     * @throws TypeExistsException
     * @return Type
     */
    public function create(Accountable $entity, bool $auth = false) : Type 
    {            
        $type = $this->finder()->find($entity);

        if ($type != null) {
            return $type;
        }

        return $this->save($entity, $auth);
    }

    public function findOrCreate(Accountable $entity) : Type
    {
        $type = $this->finder()->find($entity);

        return $type == null ? $this->create($entity) : $type;
    }

    /**
     * Salva as informações 
     *
     * @param Accountable $entity
     * @param boolean $auth
     * @param Type|null $type
     * @return Type
     */
    public function save(Accountable $entity, bool $auth, Type $type = null) : Type
    {   
        $type = $type ?? new Type();

        $type->auth  = $auth;       
        $type->token = $this->getToken($entity);
        $type->name  = $this->getClassName($entity);
        
        $type->save();

        return $type;
    }

    /**
     * Retorna o token unico relacionado a classe. 
     * Caso não encontre, deve ser disparado um exception. 
     *
     * @param Accountable $entity
     * @throws TokenNotFoundException
     * @return string
     */
    protected function getToken(Accountable $entity) : string
    {
        $token = trim($entity->token());

        if (strlen($token) == 0) {
            throw new TokenNotFoundException($entity);
        }

        return $entity->token();
    }
}