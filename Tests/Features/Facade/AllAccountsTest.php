<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Users\Support\Facade\Users;
use Maestro\Accounts\Support\Facades\Accounts;

class AllAccountsTest extends TestCase
{
    public function testGetAllAccounts()
    {
        $this->createAccounts();

        $accounts = Accounts::account()->all();

        $this->assertFalse($accounts->isEmpty());
    }


    private function createAccounts()
    {
        $name = 'my.f4ke-user';
        $user = Users::factory()->model();

        Accounts::account()->create($user, $name);
    }
}