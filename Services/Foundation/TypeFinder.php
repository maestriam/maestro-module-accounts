<?php

namespace Maestro\Accounts\Services\Foundation;

use Illuminate\Database\Eloquent\Collection;
use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Exceptions\TypeExistsException;
use Maestro\Accounts\Exceptions\TypeNotFoundException;
use Maestro\Accounts\Support\Abstraction\Accountable;
use Maestro\Accounts\Support\Concerns\RetrivesClassName;

class TypeFinder
{    
    use RetrivesClassName;

    /**
     * Executa uma pesquisa de um tipo de conta através de
     * uma entidade Accountable. 
     *
     * @param Accountable $search
     * @return Type|null
     */
    public function findByAccountable(Accountable $search) : ?Type
    {
        $params = [
            'name'  => $this->getClassName($search), 
            'token' => trim($search->token())
        ];

        return Type::where($params)->first();
    }

    /**
     * Executa uma pesquisa de um tipo de conta através 
     * nome da classe ou pelo token.  
     *
     * @param string $search
     * @return Type|null
     */
    public function findBySignature(string $search) : ?Type
    {
        $token = ['token' => $search];
        $class = ['name' => $search];

        return Type::where($token)->orWhere($class)->first();
    }

    /**
     * Executa uma pesquisa de um tipo de conta através de
     * um id específico. 
     * 
     * @param  int $id
     * @return Type        
     */
    public function findById(int $id) : ?Type
    {
        return Type::find($id);
    }

    /**
     * Pesquisa um tipo de conta através 
     * de seu nome ou ID.
     *
     * @param Accountable|int $search
     * @return Type|null
     */
    public function find(Accountable|string|int $search) : ?Type
    {
        return match(true) {
            is_string($search) => $this->findBySignature($search),
            is_int($search)    => $this->findById($search),
            default            => $this->findByAccountable($search)
        };
    }

    /**
     * Executa uma pesquisa de tipo de conta. Caso não encontre nenhum
     * resultado, deve disparar uma mensagem de erro.
     *
     * @param string|integer|Accountable $search
     * @throws TypeNotFoundException
     * @return Type
     */
    public function findOrFail(string|int|Accountable $search) : Type
    {
        $type = $this->find($search);
        
        if ($type == null) {
            throw new TypeNotFoundException($search);            
        }
        
        return $type;
    }

    /**
     * Retorna todos os tipos de contas cadastrados
     *
     * @return Collection
     */
    public function all() : Collection
    {
        return Type::all();
    }
}