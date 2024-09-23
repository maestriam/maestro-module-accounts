<?php

namespace Maestro\Accounts\Services\Foundation;

use Illuminate\Support\Collection;
use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Entities\Relation;
use Maestro\Accounts\Support\Abstraction\Accountable;
use Maestro\Accounts\Support\Concerns\SearchesAccounts;
use Illuminate\Database\Eloquent\Collection as DbCollection;

class RelationHandler
{
    use SearchesAccounts;
    
    /**
     * Retorna uma coleção com TODAS as relações cadastradas no sistema.
     * Deve ser executada com parcimônia para não ocorrer degradação
     * do banco de dados. 
     *
     * @return DbCollection
     */
    public function all() : DbCollection
    {
        return Relation::all();
    }

    /**
     * Retorna a relação de todas as entidades, onde 
     * a conta da entidade está inserida.
     *
     * @param Accountable|Account|string|int $child
     * @return Collection
     */
    public function parents(
        Accountable|Account|string|int $child, 
        string $token = null
    )  : Collection {

        $collection = $this->find($child, $token);

        return $this->toEntity($collection);  
    }

    /**
     * Retorna a relação de todas as entidades, que 
     * a conta da entidade possui em seu inventário
     *
     * @param integer $parent
     * @return Collection
     */
    public function children(
        Accountable|Account|string|int $parent, 
        string $token = null
    ) : Collection {
        
        $collection = $this->find($parent, $token, false);

        return $this->toEntity($collection);
    }    

    /**
     * Retorna uma coleção de contas onde a entidade está vinculada 
     * como membro/pertencente. 
     *
     * @param Accountable|Account|string|integer $child
     * @param string|null $token
     * @return DbCollection
     */
    private function find(
        Accountable|Account|string|int $child,
        string $token = null,
        bool $parent = true
    ) : DbCollection {

        $id = $this->getAccountId($child);

        $target = ($parent == true) ? 'R.parent_id' : 'R.child_id';
        $filter = ($parent == true) ? 'R.child_id' : 'R.parent_id';
        $clause = [$filter => $id];

        if ($token) $clause['token'] = $token;

        return Account::join('account_relations as R', 'accounts.id', '=', $target)
                      ->join('account_types as T', 'T.id', '=', 'accounts.type_id')
                      ->where($clause)
                      ->get(['accounts.*']);
    }

    /**
     * Recebe uma coleção de dados de conta e 
     * retorna o objeto Accountable responsável por cada conta. 
     *
     * @param DbCollection $collection
     * @return Collection
     */
    private function toEntity(DbCollection $collection) : Collection
    {
        $entities = [];

        foreach ($collection as $account) {
            $entities[] = $this->finder()->entity($account->id);
        }

        return collect($entities);
    }

    /**
     * Tenta recuperar o ID de uma conta
     *
     * @param Accountable|Account|string|integer $entity
     * @return integer
     */
    private function getAccountId(Accountable|Account|string|int $entity) : int
    {
        if ($this->finder()->isAccount($entity)) {
            return $entity->id;
        }

        return $this->finder()->findOrFail($entity)->id;
    }    

    /**
     * Undocumented function
     *
     * @todo Mudar ordem do vinculo. Colocar o pai como primeiro 
     * parâmetro e o filho como segundo. 
     * @todo Fazer relação via Account, accountId e Accountable
     * @param Accountable|Account|int $child
     * @param Accountable|Account|int $parent
     * @return boolean
     */
    public function relate(
        Accountable|Account|int $child, 
        Accountable|Account|int $parent
    ) : bool {

        Relation::updateOrCreate([
            'child_id' =>  $child->account()->id,
            'parent_id' => $parent->account()->id
        ]);

        return true;
    }

    public function unrelate(object $child, object $parent) : bool
    {
        Relation::where(
            ['child_id' =>  $child->account()->id],
            ['parent_id' => $parent->account()->id]
        )->delete();

        return true;
    }
}