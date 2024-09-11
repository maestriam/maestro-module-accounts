<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\AccountFinder;

use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Support\Concerns\SearchesAccounts;
use Maestro\Accounts\Tests\TestCase;

class IsAccountTest extends TestCase
{
    use SearchesAccounts;

    public function testIsAcccount()
    {
        $entity  = $this->makeMock();
        $account = new Account();

        $positive = $this->finder()->isAccount($account);
        $negative = $this->finder()->isAccount($entity);

        $this->assertTrue($positive);
        $this->assertFalse($negative);
    }
}