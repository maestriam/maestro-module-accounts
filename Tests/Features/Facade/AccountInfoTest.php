<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Support\Accounts;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Users\Support\Users;

class AccountInfoTest extends TestCase 
{
    public function testAccountInfo()
    {
        $user = Users::factory()->model();                           

        Accounts::account()->create($user, 'x');
        
        $account = Accounts::account()->info($user);

        $this->assertInstanceOf(Account::class, $account);
        $this->assertInstanceOf(Type::class, $account->type);
    }
}