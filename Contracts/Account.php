<?php

namespace Maestro\Accounts\Contracts;

interface Account
{
    /**
     * Retorna a lista de TODAS as contas registradas no sistema
     *
     * @return void
     */
    public function all();
}