<?php

namespace Maestro\Accounts\Views\Components;

use Livewire\Component;
use Livewire\Attributes\Modelable;
use Maestro\Accounts\Support\Facades\Accounts;

class AccountForm extends Component
{
    public bool $readOnly = false;

    #[Modelable] 
    public $account = "";

    private string $keySession = 'account.error';

    /**
     * Verifica se a conta fornecida pelo usuário já existe na base.
     *
     * @return boolean
     */
    private function accountExists() : bool
    {
        return Accounts::account()->isExists($this->account);
    }

    /**
     * Retorna uma mensagem informando se o nome da conta 
     * já está em uso ou não.  
     *
     * @return string
     */
    private function accountMessage() : string {

        if (strlen($this->account) == 0) return "";

        return $this->accountExists() ? 
            __('accounts::validations.unavailable') :
            __('accounts::validations.available');
    }

    /**
     * Retorna uma mensagem de erro caso houve algum erro de validação 
     * no formulário-pai que invocou este componente. 
     *
     * @return string|null
     */
    private function getAccountError() : ?string 
    {
        if (! $this->hasError()) return null;

        $message = session($this->keySession);

        session()->forget($this->keySession);

        return $message;
    }

    /**
     * Verifica se houve algum erro de validação no formulário-pai
     * que invocou este componente. 
     *
     * @return boolean
     */
    private function hasError() : bool
    {
        return (session($this->keySession)) ? true : false;
    }

    /**
     * Se houver algum erro de validação relacionado ao nome da conta 
     * no formulário-pai que chamou este componente, 
     * o estilo do campo de entrada do nome da conta deve ser alterado.
     *
     * @return string|null
     */
    private function getErrorStyleInput() : ?string 
    {
        $class  = 'form-control ';
        $class .= ($this->hasError()) ? 'is-invalid' : '';
        
        return $class;
    }

    /**
     * Retorna o estilo da mensagem sobre o nome da conta. 
     *
     * @return string
     */
    private function accountStyle() : string 
    {
        return $this->accountExists() ? 'text-danger' : 'text-success';
    }

    /**
     * Retorna o tipo de ícone de acordo com a validação do nome da conta. 
     *
     * @return string
     */
    private function accountIcon() : string 
    {
        if (strlen($this->account) == 0) return "";

        return $this->accountExists() ? 'fa-times-circle' : 'fa-check-circle'; 
    }

    /**
     * Renderiza o componente na tela.  
     *
     * @return void
     */
    public function render()
    {
        return view('accounts::components.account-form');
    }
}