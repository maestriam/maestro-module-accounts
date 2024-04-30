<?php

namespace Maestro\Accounts\Contracts;

use Illuminate\Support\Collection;
use Maestro\Accounts\Database\Models\Account as Account;

interface AccountFacade
{
    /**
     * Registra o nome da conta da entidade, de acordo com o tipo específico.  
     *
     * @param Account $account
     * @param object $entity
     * @param Type $type
     * @return Account
     */
    public function create(object $entity, string $name, string $type = null) : Account;

    /**
     * Atualiza o nome da conta da entidade, de acordo com o tipo específico.  
     *
     * @param Account $account
     * @param object $entity
     * @param Type $type
     * @return Account
     */
    public function update(object $entity, string $name, string $type = null) : Account;

    /**
     * Verifica se o nome da conta já existe na base de dados
     *
     * @param string $name
     * @return boolean
     */
    public function isExists(string $name) : bool;

    /**
     * Verifica se o nome da conta está vinculada a uma determinada entidade.
     * Caso não pertença, deve retornar false.  
     *
     * @param object|null $entity
     * @param string $name
     * @return boolean
     */
    public function belongsTo(?object $entity, string $name) : bool;

    /**
     * Retorna os dados da conta através do objeto da entidade, 
     * id da conta ou nome da conta.  
     * Caso não encontre nenhuma informação, lança um exception. 
     *
     * @param string|object|integer $search
     * @return Account
     */
    public function findOrFail(string|object|int $search) : Account;

    /**
     * Cria um vínculo de chave pai e filho entre duas entidades 
     *
     * @param object $child
     * @param object $parent
     * @return boolean
     */
    public function relate(object $child, object $parent) : bool;

    /**
     * Remove um vínculo de chave pai e filho entre duas entidades. 
     *
     * @param object $child
     * @param object $parent
     * @return boolean
     */
    public function unrelate(object $child, object $parent) : bool;

    /**
     * Retorna a relação de todas as entidades onde 
     * a conta da entidade está inserida.
     *
     * @param integer $child
     * @return Collection
     */
    public function parents(int $child) : Collection;

    /**
     * Retorna a lista de todas as entidades que 
     * possui vinculo com essa conta.
     *
     * @param integer $child
     * @return Collection
     */
    public function children(int $child) : Collection;
}