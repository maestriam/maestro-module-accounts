<?php

namespace Maestro\Accounts\Services\Foundation;

use Maestro\Accounts\Database\Models\Type;
use Maestro\Accounts\Database\Models\Account;
use Maestro\Accounts\Support\Concerns\StoresTypes;
use Maestro\Accounts\Support\Concerns\SearchesTypes;
use Maestro\Accounts\Support\Concerns\SearchesAccount;
use Maestro\Accounts\Exceptions\AccountModelNotAllowedException;

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
        $this->guard($entity, $name);

        $account = new Account();                    

        $type = $this->getType($entity, $type);

        return $this->save($name, $account, $entity, $type);
    }

    /**
     * 
     */
    public function update(object $entity, string $name) : Account
    {            
        $this->guard($entity, $name);

        $account = $this->accountFinder()->findOrFail($entity);

        return $this->save($name, $account, $entity, $account->type);
    }

    /**
     * Protege da inserção de dados de conta inválidos 
     * no banco de dados.  
     * Em caso de alguma de negócio estiver errado deve disparar
     * uma exception. 
     *
     * @param StoreUserRequest|array $request
     * @return boolean
     */
    public function guard(object $entity, string $name) : bool
    {            
        $this->accountFinder()->notExistsOrFail($name);

        if ($this->isAccountModel($entity)) {
            return throw new AccountModelNotAllowedException();
        }

        return true;
    }

    /**
     * Verifica se a instância da entidade passada se trata de um Account.
     *
     * @param object $entity
     * @return boolean
     */
    private function isAccountModel(object $entity) : bool
    {
        return (is_a($entity, Account::class));
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
    private function save(string $name, Account $account, object $entity, Type $type) : Account
    {
        $account->type_id   = $type->id;      
        $account->entity_id = $entity->id;
        $account->name      = $name;

        $account->save();

        return $account;
    } 

    public function delete(Account $account) : ?bool
    {
        return $account->delete();
    }
}
