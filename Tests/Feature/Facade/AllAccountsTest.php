<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Users\Support\Users;
use Maestro\Accounts\Support\Accounts;

class AllAccountsTest extends TestCase
{
    public function testGetAllAccounts()
    {
        $this->makeAccount();

        $accounts = Accounts::account()->all();

        $this->assertFalse($accounts->isEmpty());
        $this->assertCount(1, $accounts);
    }
}