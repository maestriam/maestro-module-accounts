<?php

namespace Maestro\Accounts\Services\Foundation;

use Maestro\Accounts\Entities\Type;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Maestro\Accounts\Support\Concerns\CreatesTypes;
use Maestro\Accounts\Support\Concerns\SearchesTypes;

class TypeHandler
{
    use CreatesTypes, 
        SearchesTypes;

    private string|object|null $entity = null;

    public function __construct(string|object $name = null)
    {
        $this->entity = $name;
    }

    /**
     * {@inheritDoc}
     */
    public function find(string|int|object $search) : ?Type
    {
        return $this->search()->find($search);
    }

    /**
     * {@inheritDoc}
     */
    public function findOrFail(string|int|object $search) : Type
    {
        return $this->search()->findOrFail($search);
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
    public function isExists(string|object $type)
    {
        return ($this->find($type) == null) ? false : true;
    }

    /**
     * {@inheritDoc}
     */
    public function factory() : Factory
    {
        return $this->creator()->factory();
    }

    /**
     * {@inheritDoc}
     */
    public function create(string|object $name, bool $auth = false) : Type 
    { 
        return $this->creator()->create($name, $auth);
    }

    /**
     * {@inheritDoc}
     */
    public function findOrCreate(string|object $name, bool $auth = false) : Type
    {
        $type = $this->find($name);

        return (! $type) ? $this->create($name, $auth) : $type;
    }
}