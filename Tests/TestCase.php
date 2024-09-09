<?php

namespace Maestro\Accounts\Tests;

use Tests\TestCase as BaseTestCase;
use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Support\Accounts;
use Illuminate\Support\Facades\Artisan;
use Maestro\Accounts\Tests\Mocks\Entity;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestCase extends BaseTestCase
{  
    use WithFaker;

    /**
     * Ao iniciar os testes...
     *
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();
        $this->migrate();
    }

    /**
     * Ao encerrar os testes...
     *
     * @return void
     */
    public function tearDown() : void
    {
        $this->rollback();
        parent::tearDown();
    }

    /**
     * Executa a criação das tabelas do módulo no banco de dados.
     *
     * @return void
     */
    private function migrate()
    {
        Artisan::call('maestro:migrate Accounts');
    }

    /**
     * Desfaz a criação das tabelas do módulo no banco de dados. 
     *
     * @return void
     */
    public function rollback()
    {
        Artisan::call('maestro:rollback Accounts');
    }

    /**
     * Retorna os dados fakes de uma conta para ser utilizado 
     * em testes 
     *
     * @return Factory 
     */
    public function makeAccount() : Account
    {
        return Accounts::factory()->account()->model();
    }

    /**
     * Retorna os dados fakes de um tipo de conta para ser utilizado 
     * em testes 
     *
     * @return Type 
     */
    public function makeType() : Type
    {
        return Accounts::factory()->type()->model();
    }

    /**
     * Retorna uma instância de um objeto fictício para 
     * realização de testes.  
     * Caso não queira uma conta vinculada a entidade, 
     * basta passar o parâmetro $makeAccount como false.  
     *
     * @param boolean $makeAccount
     * @return Entity
     */
    protected function makeMock(bool $makeAccount = true) : Entity
    {
        $entity = new Entity();

        if ($makeAccount) {
            $name = $this->faker()->userName();
            Accounts::account()->creator()->create($entity, $name);
        }

        return $entity;
    }
}