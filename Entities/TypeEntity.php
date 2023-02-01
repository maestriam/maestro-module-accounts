<?php

namespace Maestro\Accounts\Entities;

use Maestro\Accounts\Database\Models\Type;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Maestro\Accounts\Exceptions\TypeExistsException;
use Maestro\Accounts\Services\Foundation\FindTypeService;
use Maestro\Accounts\Services\Foundation\StoreTypeService;

class TypeEntity
{
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
        if ($this->find($name)) {
            throw new TypeExistsException($name);
        }

        $type = new Type();

        return $this->creator()->save($type, $name, $auth);
    }

    /**
     * {@inheritDoc}
     */
    public function findOrCreate(string|object $name, bool $auth = false) : Type
    {
        $type = $this->find($name);

        return (! $type) ? $this->create($name, $auth) : $type;
    }

    /**
     * Retorna a instância com as RN's sobre 
     * a persistência de tipo de contas.
     *
     * @return StoreTypeService
     */
    private function creator() : StoreTypeService
    {
        return app()->make(StoreTypeService::class);
    }

    /**
     * Retorna a instância com as RN's sobre 
     * a pesquisa de tipo de contas.
     *
     * @return FindTypeService
     */
    private function search() : FindTypeService
    {
        return app()->make(FindTypeService::class);
    }
}