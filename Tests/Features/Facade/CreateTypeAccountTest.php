<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Database\Models\Type;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Support\Facades\Accounts;

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