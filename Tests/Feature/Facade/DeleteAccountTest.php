<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Support\Accounts;
use Maestro\Accounts\Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    public function testDeleteAccount()
    {
        $account = $this->makeAccount();

        $ret = Accounts::account()->delete($account->name);        

        $this->assertTrue($ret);
    }
}