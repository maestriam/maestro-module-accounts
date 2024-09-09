<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Support\Accounts;
use Maestro\Accounts\Support\Concerns\RetrivesClassName;
use Maestro\Accounts\Tests\Mocks\Entity;

class CreateTypeAccountTest extends TestCase
{
    use RetrivesClassName;

    public function testCreateAccount()
    {
        $mock = new Entity();   
        $type = Accounts::type()->create($mock);
        $name = $this->getClassName($mock);

        $this->assertInstanceOf(Type::class, $type);
        $this->assertEquals($name, $type->name);        
    }
}