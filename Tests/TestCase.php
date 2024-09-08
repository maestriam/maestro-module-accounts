<?php

namespace Maestro\Accounts\Tests;

use Maestro\Users\Support\Users;
use Maestro\Users\Entities\User;
use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Support\Accounts;
use Illuminate\Foundation\Testing\WithFaker;
use Maestro\Accounts\Tests\Mocks\EntityMOck;
use Maestro\Admin\Tests\TestCase as MainTestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Maestro\Accounts\Tests\Mocks\Entity;
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

    /**
     * Retorna uma instância de um objeto fictício para 
     * realização de testes.  
     * Caso queira que não possua uma conta vinculada, basta passar
     * o parâmetro $makeAccount como false.  
     *
     * @param boolean $makeAccount
     * @return Entity
     */
    protected function makeMock(bool $makeAccount = true) : Entity
    {
        $entity = new Entity();

        if ($makeAccount) {

            $name = $this->faker()->userName();

            Accounts::account()->create($entity, $name);
        }

        return $entity;
    }

    /**
     * Retorna um model de um usuário ficticio para testes
     *
     * @param integer|null $qty
     * @return User|array
     * 
     * @todo Deve-se pensar outro jeito de não implementar usuário
     * sem precisar de colocar o módulo maestro/user;
     */
    public function makeUser(int $qty = null) : User|array
    {
        return ($qty == null) ? 
            Users::factory()->model() : 
            Users::factory()->populate($qty);
    }
}