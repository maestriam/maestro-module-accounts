<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Support\Accounts;
use Maestro\Accounts\Tests\TestCase;

class AccountExistsTest extends TestCase
{    
    public function testIsAccountExists()
    {
        $account = Accounts::account()->isExists('not-found');

        $this->assertFalse($account);
    }
}