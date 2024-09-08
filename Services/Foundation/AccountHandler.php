<?php

namespace Maestro\Accounts\Services\Foundation;

use Maestro\Accounts\Entities\Account;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Maestro\Accounts\Support\Concerns\CreatesAccounts;
use Maestro\Accounts\Support\Concerns\AccountRelationship;
use Maestro\Accounts\Support\Concerns\SearchesAccounts;

class AccountHandler
{
    use CreatesAccounts, 
        SearchesAccounts, 
        AccountRelationship;

    /**
     * {@inheritDoc}
     */
    public function create(object $entity, string $name, string $type = null) : Account
    {                
        return $this->creator()->create($entity, $name, $type);
    }

    /**
     * {@inheritDoc}
     */
    public function update(object $entity, string $name, string $type = null) : Account
    {
        return $this->creator()->update($entity, $name, $type);
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
        return $this->finder()->all();
    }

    /**
     * {@inheritDoc}
     */
    public function find(string|int|object $search) : ?Account
    {
        return $this->finder()->find($search);
    }

    /**
     * {@inheritDoc}
     */
    public function findOrFail(string|object|int $search): Account
    {
        return $this->finder()->findOrFail($search);
    }
    
    /**
     * {@inheritDoc}
     */
    public function isExists(string $name) : bool
    {        
        return $this->finder()->isExists($name);
    }

    /**
     * {@inheritDoc}
     */
    public function info(object $info)
    {
        return $this->finder()->info($info);
    }

    /**
     * {@inheritDoc}
     */
    public function belongsTo(?object $entity, string $name) : bool
    {
        return $this->finder()->belongsTo($entity, $name);
    }

    /**
     * {@inheritDoc}
     */
    public function relate($entity, $to) : bool
    {
        return $this->relation()->relate($entity, $to);
    }

    public function unrelate(object $child, object $parent): bool
    {
        return $this->relation()->unrelate($child, $parent);
    }

    /**
     * {@inheritDoc}
     */    
    public function parents(int $child) : SupportCollection
    {
        return $this->relation()->parents($child);
    }

    /**
     * {@inheritDoc}
     */    
    public function children(int $child) : SupportCollection
    {
        return $this->relation()->children($child);
    }
    
    /**
     * {@inheritDoc}
     */
    public function entity(Account|int $account) : mixed
    {
        return $this->relation()->entity($account);
    }        
}