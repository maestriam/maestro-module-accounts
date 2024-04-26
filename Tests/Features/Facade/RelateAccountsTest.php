<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Users\Support\Facade\Users;
use Maestro\Accounts\Support\Facades\Accounts;

class RelateAccountsTest extends TestCase
{
    public function testRelateAccounts()
    {
        $user1 = $this->makeEntityWithAccount();
        $user2 = $this->makeEntityWithAccount();

        $response = Accounts::account()->relate($user1, $user2);

        $this->assertTrue($response);
    }

    public function testDuplicateRelations()
    {
        $child  = $this->makeEntityWithAccount();
        $parent = $this->makeEntityWithAccount();

        Accounts::account()->relate($child, $parent);
        Accounts::account()->relate($child, $parent);
                
        $relations = Accounts::account()->parents($child->account()->id);

        $this->assertEquals(1, count($relations));  
    }
}