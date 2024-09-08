<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Support\Accounts;
use Maestro\Accounts\Tests\TestCase;

class AccountInfoTest extends TestCase 
{
    public function testAccountInfo()
    {
        $mock = $this->makeMock();
        
        $account = Accounts::account()->info($mock);

        $this->assertInstanceOf(Account::class, $account);
        $this->assertInstanceOf(Type::class, $account->type);
    }
}