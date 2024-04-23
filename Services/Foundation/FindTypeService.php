<?php

namespace Maestro\Accounts\Services\Foundation;

use Illuminate\Database\Eloquent\Collection;
use Maestro\Accounts\Database\Models\Type;
use Maestro\Accounts\Exceptions\TypeNotFoundException;

class FindTypeService
{
    /**
     * Pesquisa um tipo de conta através 
     * de seu nome ou ID.
     *
     * @param string|int|object $search
     * @return Type
     */
    public function find(string|int|object $search) : ?Type
    {
        if (is_int($search)) {
            return $this->findById($search);
        }

        if (is_object($search)) {
            return $this->findByObject($search);
        }

        return $this->findByName($search);
    }

    /**
     * Undocumented function
     *
     * @param string|integer|object $search
     * @return Type
     */
    public function findOrFail(string|int|object $search) : Type
    {
        $type = $this->find($search);
        
        if ($type == null) {
            throw new TypeNotFoundException($search);            
        }
        
        return $type;
    }

    /**
     * Retorna todos os tipos cadastrados
     *
     * @return Collection
     */
    public function all() : Collection
    {
        return Type::all();
    }

    /**
     * Pesquisa o tipo de conta através de seu nome.
     *
     * @param  string $name
     * @return Type        
     */
    private function findByName(string $name) : ?Type
    {
        return Type::where('name', $name)->first();
    }

    /**
     * Pesquisa o tipo de conta através de seu ID
     *
     * @param  int $id
     * @return Type        
     */
    private function findById(int $id) : ?Type
    {
        return Type::find($id);
    }

    private function findByObject(object $object) : ?Type
    {
        $name = get_class($object);

        return $this->findByName($name);
    }
}