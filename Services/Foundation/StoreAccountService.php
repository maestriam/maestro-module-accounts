<?php

namespace Maestro\Accounts\Services\Foundation;

use Maestro\Accounts\Database\Models\Account;
use Maestro\Accounts\Database\Models\Type;

class StoreAccountService
{
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
