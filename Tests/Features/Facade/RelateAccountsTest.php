<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Users\Support\Facade\Users;
use Maestro\Accounts\Support\Facades\Accounts;

class RelateAccountsTest extends TestCase
{
    public function testRelateAccounts()
    {
        $user1 = Users::factory()->model();
        $user2 = Users::factory()->model();

        Accounts::account()->create($user1, 'my.user.1');
        Accounts::account()->create($user2, 'company.id');

        $ret = Accounts::account()->relate($user1, $user2);

        $this->assertIsBool($ret);
        $this->assertTrue($ret);
    }
}