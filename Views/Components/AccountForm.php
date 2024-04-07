<?php

namespace Maestro\Accounts\Views\Components;

use Livewire\Component;
use Livewire\Attributes\Modelable;
use Maestro\Accounts\Support\Facades\Accounts;

class AccountForm extends Component
{
    /**
     * Nome da conta. 
     *
     * @var string
     */
    #[Modelable] 
    public $account = "";

    /**
     * Indica se o campo do nome da conta deve ser readonly
     *
     * @var boolean
     */
    public bool $readOnly = false;

    /**
     * Objeto com oi
     *
     * @var object
     */
    public ?object $entity = null;

    /**
     * Undocumented variable
     *
     * @var string
     */
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
     * Retorna se o nome da conta pertence à entidade enviada.  
     * Em caso de sucesso, deve retornar true.  
     *
     * @return boolean
     */
    private function belongsToEntity() : bool
    {
        return Accounts::account()->belongsTo($this->entity, $this->account);
    }

    /**
     * Retorna uma mensagem informando se o nome da conta 
     * já está em uso ou não.  
     *
     * @return string
     */
    private function accountMessage() : string {

        if ($this->isEmpty() || $this->belongsToEntity()) {
            return "";
        }

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
        if ($this->isEmpty() || $this->belongsToEntity()) return "";

        return $this->accountExists() ? 'fa-times-circle' : 'fa-check-circle'; 
    }

    /**
     * Verifica se o campo "nome da conta" está preenchido.  
     * Em caso de sucesso, deve retornar true.   
     *
     * @return boolean
     */
    private function isEmpty() : bool 
    {
        return (strlen($this->account) == 0);
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