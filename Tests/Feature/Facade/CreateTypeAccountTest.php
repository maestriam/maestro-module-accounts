<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Support\Accounts;

class CreateTypeAccountTest extends TestCase
{
    public function testCreateAccount()
    {
        $name = sprintf('App/User%s', time());   
        $type = Accounts::type()->create($name);

        $this->assertInstanceOf(Type::class, $type);
        $this->assertEquals($name, $type->name);        
    }
}