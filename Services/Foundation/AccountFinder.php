<?php

namespace Maestro\Accounts\Services\Foundation;

use Illuminate\Database\Eloquent\Collection;
use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Exceptions\AccountNotFoundException;
use Maestro\Accounts\Exceptions\UnavailableAccountException;
use Maestro\Accounts\Support\Abstraction\Accountable;

class AccountFinder
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
     * Recebe os dados de uma conta e retorna um objeto Accountable
     * da entidade responsável pela conta. 
     *
     * @todo Conseguir materializar objeto pesquisando por nome,
     * string, accountable.
     * @param Account $account
     * @return Accountable
     */
    public function entity(int $search) : mixed
    {
        $account = $this->findOrFail($search);

        $accountable = app()->make($account->type->name);

        return $accountable->find($account->entityId);
    }

    /**
     * Verifica se o nome da conta existe.   
     * Se existir, deve lançar um exception informando que o 
     * nome da conta não está disponível. 
     *
     * @param string $name
     * @return bool
     */
    public function notExistsOrFail(string $name) : bool
    {
        if ($this->isExists($name)) {
            return throw new UnavailableAccountException();
        }

        return true;
    }

    /**
     * Verifica se o parâmetro passado se trata de uma entidade
     * Account. 
     *
     * @param mixed $param
     * @return boolean
     */
    public function isAccount(mixed $param)
    {
        return is_a($param, Account::class);
    }

    /**
     * Verifica se o nome da conta já existe na base de dados
     *
     * @deprecated version
     * @param string $name
     * @return boolean
     */
    public function isExists(string $name) : bool
    {
        return $this->find($name) == null ? false : true;
    }

    /**
     * Verifica se o nome da conta já existe na base de dados.
     * É possível passar o token do tipo de conta responsável.
     * Se a conta existir e for de um determinado tipo específico, 
     * deve retornar true.  
     *
     * @param string $name
     * @return boolean
     */
    public function exists(string $name, string $token = null) : bool
    {
        $found = $this->find($name);
        
        if ($found == null) return false; 

        if ($token == null) return true;

        return ($found->type->token == $token) ? true : false;
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
        
        $collection = Account::join('account_types as T', 'T.id', '=', 'accounts.type_id')
                             ->where('T.name', $type)
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
    public function belongsTo(?object $entity, string $name) : bool
    {
        if ($entity == null) return false;

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
    public function find(string|Accountable|Account|int $search) : ?Account
    {
        $account = match(true) {
            default                   => null,
            is_int($search)           => $this->findById($search),
            is_string($search)        => $this->findByName($search),
            is_object($search)        => $this->findByAccountable($search),
            $this->isAccount($search) => $this->findById($search->id),
        };

        return $account;
    }

    /**
     * Tenta encontrar um 
     *
     * @param string|object|integer $search
     * @return Account
     */
    public function findOrFail(string|object|int $search) : Account
    {
        $account = $this->find($search);

        if ($account == null) {
            return throw new AccountNotFoundException();            
        }

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
     * @param Accountable $entity
     * @return Account|null
     */
    private function findByAccountable(Accountable $entity) : ?Account
    {
        $name = $entity->account()->name;

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