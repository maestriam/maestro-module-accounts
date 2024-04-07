<?php

namespace Maestro\Accounts\Entities;

use Maestro\Accounts\Database\Models\Type;
use Illuminate\Database\Eloquent\Collection;
use Maestro\Accounts\Contracts\AccountFacade;
use Maestro\Accounts\Database\Models\Account;
use Maestro\Accounts\Services\Foundation\FindAccountService;
use Maestro\Accounts\Services\Foundation\RelateAccountsService;
use Maestro\Accounts\Services\Foundation\StoreAccountService;

class AccountEntity implements AccountFacade
{
    /**
     * {@inheritDoc}
     */
    public function create(object $entity, string $name, string $type = null) : Account
    {        
        $account = new Account();       

        $entity->accountName = $name;

        $type = $this->getType($entity, $type);
        
        return $this->creator()->save($account, $entity, $type);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string|int|object $search) : ?bool
    {
        $account = $this->find($search);

        if ($account == null) {
            return null;
        }

        return $this->creator()->delete($account);
    }

    /**
     * {@inheritDoc}
     */
    public function all() : Collection
    {
        return $this->search()->all();
    }

    /**
     * {@inheritDoc}
     */
    public function find(string|int|object $search) : ?Account
    {
        return $this->search()->find($search);
    }
    
    /**
     * {@inheritDoc}
     */
    public function isExists(string $name) : bool
    {
        return $this->search()->isExists($name);
    }

    /**
     * {@inheritDoc}
     */
    public function info(object $info)
    {
        return $this->search()->info($info);
    }

    /** */
    public function belongsTo(?object $entity, string $name) : bool
    {
        return $this->search()->belongsTo($entity, $name);
    }

    /**
     * {@inheritDoc}
     */
    public function relate($entity, $to) : bool
    {
        return $this->relation()->relate($entity, $to);
    }

    public function parents(int $child)
    {
        return $this->relation()->parents($child);
    }

    public function children(int $child)
    {
        return $this->relation()->children($child);
    }
    
    /**
     *
     * @param integer $id
     * @return void
     */
    public function entity(int $id)
    {
        return $this->relation()->entity($id);
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
            return $this->type()->findOrCreate($entity);
        }

        return $this->type()->findOrFail($type);
    }

    /**
     * Retorna a entidade com as regras de negócio sobre 
     * tipo da conta
     *
     * @return TypeEntity
     */
    private function type() : TypeEntity
    {
        return new TypeEntity();
    }

    /**
     * Retorna o serviço para persistência de dados da conta
     *
     * @return StoreAccountService
     */
    private function creator() : StoreAccountService
    {
        return app()->make(StoreAccountService::class);
    }

    /**
     * Retorna o serviço para consulta de dados da conta
     *
     * @return FindAccountService
     */
    private function search() : FindAccountService
    {
        return app()->make(FindAccountService::class);
    }

    /**
     * Undocumented function
     *
     * @return RelateAccountsService
     */
    private function relation() : RelateAccountsService
    {
        return app(RelateAccountsService::class);
    }
}