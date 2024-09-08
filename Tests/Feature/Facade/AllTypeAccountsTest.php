<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Support\Accounts;

class AllTypeAccountsTest extends TestCase
{
    public function testGetAllTypes()
    {
        $this->makeType();

        $types = Accounts::type()->all();

        $this->assertNotEmpty($types);        
    }
}