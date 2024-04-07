<?php

namespace Maestro\Accounts\Contracts;

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
}