<?php

namespace Maestro\Accounts\Support\Concerns;

use Illuminate\Support\MessageBag;

trait SendsAccountErrors 
{
    /**
     * Verifica se há uma mensagem de erro relacionado ao dados da conta.  
     * Se houver, a primeira mensagem será capturada e o erro será exibido na tela.  
     * Necessário que a sessão na aplicação esteja ativa.  
     *
     * @param string|array $message
     * @return void
     */
    public function dispatchAccountError(MessageBag $bag) : void
    {
        $message = $bag->get('account');

        session(['account.error' => $message[0]]);
    }
}