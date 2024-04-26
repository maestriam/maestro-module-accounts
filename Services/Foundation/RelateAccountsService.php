<?php

namespace Maestro\Accounts\Services\Foundation;

use Illuminate\Database\Eloquent\Collection;
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

    /**
     * Retorna a relação de todas as entidades, onde 
     * a conta da entidade está inserida.
     *
     * @param integer $child
     * @return array
     */
    public function parents(int $child) : array
    {
        $collection = $this->getParentsCollection($child);

        return $this->getEntityCollection($collection, 'parent_id');
    }

    /**
     * Retorna a relação de todas as entidades, que 
     * a conta da entidade possui em seu inventário
     *
     * @param integer $parent
     * @return void
     */
    public function children(int $parent)
    {
        $collection = $this->getChildrenCollection($parent);

        return $this->getEntityCollection($collection, 'child_id');
    }

    private function getEntityCollection($collection, string $key) : array
    {
        $entities = [];

        foreach ($collection as $relation) {

            $entity = $this->entity($relation->$key);         

            $entities[] = $entity;
        }

        return $entities;
    }

    /**
     * Retorna a entidade da conta de acordo com o seu ID. 
     *
     * @param integer $id
     * @return void
     */
    public function entity(int $id)
    {
        $account = Account::find($id);

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