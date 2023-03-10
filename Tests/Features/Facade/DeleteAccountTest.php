<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Support\Facades\Accounts;
use Maestro\Accounts\Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    public function testDeleteAccount()
    {
        $account = $this->accountFactory()->create();

        $ret = Accounts::account()->delete($account->name);        

        $this->assertTrue($ret);
    }
}