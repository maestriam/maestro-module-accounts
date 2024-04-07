<?php

namespace Maestro\Accounts\Services\Foundation;

use Illuminate\Database\Eloquent\Collection;
use Maestro\Accounts\Database\Models\Account;

class FindAccountService
{
    /**
     * Retorna TODAS as contas cadastradas no banco
     *
     * @return Collection
     */
    public function all() : Collection
    {
        return Account::all();
    }

    /**
     * Verifica se o nome da conta já existe na base de dados
     *
     * @param string $name
     * @return boolean
     */
    public function isExists(string $name) : bool
    {
        return $this->find($name) == null ? false : true;
    }

    /**
     * Retorna todas as informações da conta de uma entidade.
     * Caso o nome do tipo da conta não seja passada, irá buscar pelo
     * nome da classe da entidade.  
     *
     * @param object $info
     * @param string $typename
     * @return Account|null
     */
    public function info(object $entity, string $typename = null) : ?Account
    {
        $type = $typename ?? get_class($entity);        
        
        $collection = Account::join('account_types as t', 't.id', '=', 'accounts.type_id')
                             ->where('t.name', $type)
                             ->where('entity_id', $entity->id)
                             ->with('type')
                             ->get(['accounts.*']); 

        return ($collection->isEmpty()) ? null : $collection->first();
    }

    /**
     * Verifica se o nome da conta está vinculada a uma determinada entidade.
     * Caso não pertença, deve retornar false.  
     *
     * @param object $entity
     * @param string $name
     * @return boolean
     */
    public function belongsTo(object $entity, string $name) : bool
    {
        $info = $this->info($entity);

        if ($info == null) return false;        
        
        return ($info->name == $name);
    }

    /**
     * Pesquisa uma conta através do seu nome, ID ou tipo de objeto.
     * Caso seja passado um objeto, ele deve conter a trait HasAccount.
     * 
     * @param string|object|integer $search
     * @return Account|null
     */
    public function find(string|object|int $search) : ?Account
    {
        $account = match(true) {
            is_int($search)    => $this->findById($search),
            is_string($search) => $this->findByName($search),
            is_object($search) => $this->findByObject($search),
        };

        return $account;
    } 

    /**
     * Pesquisa os dados da conta através do seu nome.
     *
     * @param string $name
     * @return Account|null
     */
    private function findByName(string $name) : ?Account
    {
        return Account::where('name', $name)->first();
    }

    /**
     * Pesquisa a conta pela função accountName.
     * É necessário que o objeto tenha o trait HasAccount.
     *
     * @param object $object
     * @return Account|null
     */
    private function findByObject(object $object) : ?Account
    {
        $name = $object->account()->name;

        return Account::where('name', $name)->first();       
    }

    /**
     * Pesquisa a conta pelo seu Id.
     *
     * @param integer $id
     * @return Account|null
     */
    private function findById(int $id) : ?Account
    {
        return Account::find($id);
    }
}