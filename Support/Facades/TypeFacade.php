<?php

namespace Maestro\Accounts\Support\Facades;

use Maestro\Accounts\Entities\Type;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Maestro\Accounts\Support\Abstraction\Accountable;
use Maestro\Accounts\Support\Concerns\CreatesTypes;
use Maestro\Accounts\Support\Concerns\SearchesTypes;

class TypeFacade
{
    use CreatesTypes, 
        SearchesTypes;

    /**
     * {@inheritDoc}
     */
    public function find(string|int|object $search) : ?Type
    {
        return $this->finder()->find($search);
    }

    /**
     * {@inheritDoc}
     */
    public function findOrFail(string|int|object $search) : Type
    {
        return $this->finder()->findOrFail($search);
    }

    public function findOrCreate(Accountable $entity) : Type
    {
        return $this->creator()->findOrCreate($entity);
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
    public function isExists(string|object $type)
    {
        return ($this->find($type) == null) ? false : true;
    }

    /**
     * {@inheritDoc}
     */
    public function create(string|object $name, bool $auth = false) : Type 
    { 
        return $this->creator()->create($name, $auth);
    }
}