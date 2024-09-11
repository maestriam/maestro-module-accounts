<?php

namespace Maestro\Accounts\Tests;

use Tests\TestCase as BaseTestCase;
use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Support\Accounts;
use Illuminate\Support\Facades\Artisan;
use Maestro\Accounts\Tests\Mocks\Entity;
use Illuminate\Foundation\Testing\WithFaker;
use Maestro\Accounts\Support\Abstraction\Accountable;
use Maestro\Accounts\Tests\Mocks\Primary;
use Maestro\Accounts\Tests\Mocks\Secondary;

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
     * Executa a criação das tabelas do módulo de Accounts no banco de dados.
     *
     * @return void
     */
    private function migrate()
    {
        Artisan::call('maestro:migrate Accounts');
    }

    /**
     * Desfaz a criação das tabelas do módulo de Accounts no banco de dados. 
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
     * @param Accountable|null $entity
     * @param string|null $name
     * @return Account
     */
    public function makeAccount(Accountable $entity = null, string $name = null) : Account
    {
        return Accounts::factory()->account()->model($entity, $name);
    }

    /**
     * Retorna os dados fakes de um tipo de conta para ser utilizado 
     * em testes
     *
     * @param Accountable|null $entity
     * @param boolean $auth
     * @return Type
     */
    public function makeType(Accountable $entity = null, bool $auth = false) : Type
    {
        return Accounts::factory()->type()->model($entity, $auth);
    }

    /**
     * Retorna uma certa de quantidade objeto fictício para 
     * realização de testes, seguindo as mesmas regras da função 
     * makeMock.
     *
     * @param integer $quantity
     * @param boolean $makeAccount
     * @param string|null $class
     * @return array
     */
    public function populate(
        int $quantity = 10, 
        bool $makeAccount = true, 
        string $class = null
    ) : array {

        $collection = [];

        for ($i=0; $i < $quantity; $i++) { 
            $collection[] = $this->makeMock($makeAccount, $class);
        } 

        return $collection;
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
    public function makeMock(bool $makeAccount = true, string $class = null) : Entity
    {
        $entity = ($class != null) ? new $class() : new Entity();

        if ($makeAccount)
            $this->makeAccount($entity);        

        return $entity;
    }

    /**
     * Retorna duas entidades que são relacionadas entre si. 
     * Caso deseje que retorne apenas as contas vinculadas as entidades,
     * basta passar $returnAccount como true.
     *
     * @param boolean $returnAccount
     * @return array
     */
    public function makeRelation(bool $returnAccount = false) : array
    {
        $primary   = new Primary();
        $secondary = new Secondary();

        $child  = $this->makeAccount($primary);
        $parent = $this->makeAccount($secondary);
        
        Accounts::relation()->relate($secondary, $primary);        

        $response = ($returnAccount == true) ? 
            [$parent, $child] : [$primary, $secondary];

        return $response;           
    }
}