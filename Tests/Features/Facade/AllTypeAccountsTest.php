<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Support\Facades\Accounts;

class AllTypeAccountsTest extends TestCase
{
    public function testGetAllTypes()
    {
        Accounts::type()->factory()->create();
        Accounts::type()->factory()->create();

        $types = Accounts::type()->all();        
        $this->assertNotEmpty($types);        
    }
}