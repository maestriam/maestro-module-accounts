<?php

namespace Maestro\Accounts\Tests;

use Maestro\Admin\Tests\TestCase as MainTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Maestro\Accounts\Database\Models\Type;
use Maestro\Accounts\Database\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Maestro\Accounts\Support\Facades\Accounts;
use Maestro\Accounts\Tests\Mocks\UserMock;

class TestCase extends MainTestCase
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
        $this->start()->initSession();
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
     * @return UserMock
     */
    public function makeEntityWithAccount() : UserMock
    {
        $entity = new UserMock();

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