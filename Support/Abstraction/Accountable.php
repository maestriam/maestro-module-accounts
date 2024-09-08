<?php

namespace Maestro\Accounts\Support\Abstraction;

use Illuminate\Database\Eloquent\Model;
use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Support\Concerns\SearchesAccounts;

abstract class Accountable extends Model
{
    use SearchesAccounts;

    /**
     * Retorna as informações da conta da entidade. 
     *
     * @return Account|null
     */
    public function account() : ?Account
    {
        return $this->finder()->info($this);
    }

    /**
     * Retorna uma chave única responsável pela identificação
     * da classe da entidade dentro do projeto.   
     * Essa chave será utilizada para materializar o objeto
     *
     * @return string
     */
    abstract public function token() : string;
}