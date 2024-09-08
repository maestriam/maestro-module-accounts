<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Support\Accounts;
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
        $mock = $this->makeMock(false);
                
        $account = Accounts::account()->creator()->create($mock, $name);

        $this->assertInstanceOf(Account::class, $account);
        $this->assertEquals($name, $account->name);
    }
}