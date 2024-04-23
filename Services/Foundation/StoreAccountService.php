<?php

namespace Maestro\Accounts\Services\Foundation;

use Maestro\Accounts\Database\Models\Type;
use Maestro\Accounts\Database\Models\Account;
use Maestro\Accounts\Support\Concerns\StoresTypes;
use Maestro\Accounts\Support\Concerns\SearchesTypes;
use Maestro\Accounts\Support\Concerns\SearchesAccount;

class StoreAccountService
{    
    use SearchesTypes,
        StoresTypes,
        SearchesAccount;

    /**
     * Executa a criação de um nova conta
     *
     * @param object $entity
     * @param string $name
     * @param string|null $type
     * @return Account
     */
    public function create(object $entity, string $name, string $type = null) : Account
    {
        $account = new Account();
              
        $entity->accountName = $name;

        $type = $this->getType($entity, $type);

        return $this->save($account, $entity, $type);
    }

    public function update(object $entity, string $name)
    {
        $account = $this->accountFinder()->findOrFail($entity);
    }

    /**
     * Retorna o tipo
     *
     * @param object $entity
     * @param string $type
     * @return Type
     */
    private function getType(object $entity, string $type = null) : Type
    {
        if ($type == null) {
            return $this->typeCreator()->findOrCreate($entity);
        }

        return $this->typeFinder()->findOrFail($type);
    }

    /**
     * Registra o nome da conta da entidade, de acordo com o tipo específico.  
     *
     * @param Account $account
     * @param object $entity
     * @param Type $type
     * @return Account
     */
    public function save(Account $account, object $entity, Type $type) : Account
    {
        $account->type_id   = $type->id;      
        $account->entity_id = $entity->id;
        $account->name      = $entity->accountName;

        $account->save();

        return $account;
    } 

    public function delete(Account $account) : ?bool
    {
        return $account->delete();
    }
}
