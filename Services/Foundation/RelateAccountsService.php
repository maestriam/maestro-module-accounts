<?php

namespace Maestro\Accounts\Services\Foundation;

use Illuminate\Support\Collection;
use Maestro\Accounts\Database\Models\Account;
use Maestro\Accounts\Database\Models\Relation;

class RelateAccountsService
{
    public function relate(object $child, object $parent) : bool
    {
        Relation::updateOrCreate(
            ['child_id' =>  $child->account()->id],
            ['parent_id' => $parent->account()->id]
        );

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

    /**
     * Retorna a relação de todas as entidades, onde 
     * a conta da entidade está inserida.
     *
     * @param integer $child
     * @return Collection
     */
    public function parents(int $child) : Collection
    {
        $collection = $this->getParentsCollection($child);

        return $this->getEntityCollection($collection, 'parent');
    }

    /**
     * Retorna a relação de todas as entidades, que 
     * a conta da entidade possui em seu inventário
     *
     * @param integer $parent
     * @return Collection
     */
    public function children(int $parent) : Collection
    {
        $collection = $this->getChildrenCollection($parent);

        return $this->getEntityCollection($collection, 'child');
    }

    private function getEntityCollection($collection, string $key) : Collection
    {
        $entities = [];

        foreach ($collection as $relation) {

            $entity = $this->entity($relation->$key);         

            $entities[] = $entity;
        }

        return collect($entities);
    }

    /**
     * Retorna a entidade da conta de acordo com a sua conta. 
     *
     * @param integer $id
     * @return void
     */
    public function entity(Account|int $account)
    {
        if (is_int($account)) {
            $account = Account::find($account);
        }

        $class = app()->make($account->type->name);

        return $class->find($account->entity_id);
    }

    /**
     * Retorna a coleção de relacionamentos dado o ID da conta filha. 
     *
     * @param integer $child
     * @return Collection
     */
    private function getParentsCollection(int $child) : Collection
    {
        return Relation::where('child_id', $child)
                        ->with('parent')
                        ->with('child')
                        ->get(); 
    }

    /**
     * Retorna a coleção de relacionamentos dado o ID da conta pai.
     *
     * @param integer $parent
     * @return void
     */
    private function getChildrenCollection(int $parent)
    {
        return Relation::where('parent_id', $parent)
                        ->with('parent')
                        ->with('child')
                        ->get();
    }
}