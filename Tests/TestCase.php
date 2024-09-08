<?php

namespace Maestro\Accounts\Tests;

use Maestro\Admin\Tests\TestCase as MainTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Entities\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Maestro\Accounts\Support\Accounts;
use Maestro\Accounts\Tests\Mocks\EntityMOck;
use Maestro\Users\Support\Concerns\WithUserFactory;

class TestCase extends MainTestCase
{  
    use WithFaker, WithUserFactory;

    /**
     * Ao iniciar os testes...
     *
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();
        $this->start();
        $this->initSession();
    }
    
    /**
     * Ao encerrar os testes...
     *
     * @return void
     */
    public function tearDown() : void
    {
        $this->finish();
        parent::tearDown();
    }

    /**
     * Retorna um objeto de entidade fictício com dados de uma conta
     *
     * @return EntityMOck
     */
    public function makeEntityWithAccount() : EntityMOck
    {
        $entity = new EntityMOck();

        $name = $this->faker()->userName();

        Accounts::account()->create($entity, $name);

        return $entity;
    }

    /**
     * Retorna os dados fakes de um tipo de conta para ser utilizado 
     * em testes 
     *
     * @return Factory 
     */
    public function typeFactory() : Factory
    {
        return Type::factory();
    }

    /**
     * Retorna os dados fakes de uma conta para ser utilizado 
     * em testes 
     *
     * @return Factory 
     */
    public function accountFactory() : Factory
    {        
        $type = $this->typeFactory()->create();

        $factory = Account::factory()->for($type);

        return $factory;                          
    }
}