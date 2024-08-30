<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Database\Models\Account;
use Maestro\Accounts\Database\Models\Type;
use Maestro\Accounts\Support\Facades\Accounts;
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