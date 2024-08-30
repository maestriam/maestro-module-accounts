<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Database\Models\Account;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Support\Facades\Accounts;
use Maestro\Users\Support\Users;

class CreateAccountTest extends TestCase
{
    /**
     * Deve criar uma conta na base e vincular à um usuário
     *
     * @return void
     */
    public function testCreateAccount()
    {  
        $name = 'my.account'; 
                       
        $user = Users::factory()->model();
                
        $account = Accounts::account()->create($user, $name);

        $this->assertInstanceOf(Account::class, $account);
    }
}