<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Users\Support\Users;
use Maestro\Accounts\Support\Accounts;

class RelateAccountsTest extends TestCase
{
    public function testRelateAccounts()
    {
        $child  = $this->makeMock();
        $parent = $this->makeMock();

        $response = Accounts::account()->relate($child, $parent);

        $this->assertTrue($response);
    }

    public function testDuplicateRelations()
    {
        $child  = $this->makeMock();
        $parent = $this->makeMock();

        Accounts::account()->relate($child, $parent);
        Accounts::account()->relate($child, $parent);
                
        $relations = Accounts::account()->parents($child->account()->id);

        $this->assertCount(1, $relations);
    }
}