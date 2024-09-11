<?php

namespace Maestro\Accounts\Services\Foundation;

use Maestro\Accounts\Entities\Type;
use Illuminate\Database\Eloquent\Collection;
use Maestro\Accounts\Support\Abstraction\Accountable;
use Maestro\Accounts\Exceptions\TypeNotFoundException;
use Maestro\Accounts\Support\Concerns\RetrievesClassName;

class TypeFinder
{    
    use RetrievesClassName;

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
     * @param Accountable|string|int $search
     * @return Type|null
     */
    public function find(Accountable|string|int $search) : ?Type
    {
        return match(true) {
            is_int($search)    => $this->findById($search),
            is_string($search) => $this->findBySignature($search),
            default            => $this->findByAccountable($search)
        };
    }

    /**
     * Executa uma pesquisa de tipo de conta. Caso não encontre nenhum
     * resultado, deve disparar uma mensagem de erro.
     *
     * @param Accountable|string|int $search
     * @throws TypeNotFoundException
     * @return Type
     */
    public function findOrFail(Accountable|string|int $search) : Type
    {
        $type = $this->find($search);
        
        if ($type == null) {
            throw new TypeNotFoundException($search);            
        }
        
        return $type;
    }

    /**
     * Verifica se um determinado tipo de conta existe ou não,
     * pesquisando através do seu ID, classe ou token da entidade,
     * ou entidade Accountable.
     * Caso exista, deve retornar true. Caso contrário, false. 
     *
     * @param Accountable|string|int $search
     * @return bool
     */
    public function exists(Accountable|string|int $search) : bool
    {
        return $this->find($search) == null ? false : true;
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