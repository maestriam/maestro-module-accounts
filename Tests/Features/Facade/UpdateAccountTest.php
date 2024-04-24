<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Database\Models\Account;
use Maestro\Accounts\Support\Facades\Accounts;
use Maestro\Accounts\Tests\TestCase;

class UpdateAccountTest extends TestCase
{
    public function testUpdate()
    {
        $name    = 'update-account';
        $entity  = $this->makeEntityWithAccount();              

        $updated = Accounts::account()->update($entity, $name);
        
        $this->assertInstanceOf(Account::class, $updated);
        $this->assertEquals($updated->name, $name);
    }
}