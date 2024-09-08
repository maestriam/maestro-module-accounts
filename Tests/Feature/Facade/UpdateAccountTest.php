<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Support\Accounts;
use Maestro\Accounts\Tests\TestCase;

class UpdateAccountTest extends TestCase
{
    public function testUpdate()
    {
        $name   = 'update-account';
        $entity = $this->makeMock();              

        $updated = Accounts::account()->update($entity, $name);
        
        $this->assertInstanceOf(Account::class, $updated);
        $this->assertEquals($updated->name, $name);
    }
}