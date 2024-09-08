<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Support\Accounts;

class FindAccountTest extends TestCase
{
    public function testFindAccount()
    {
        $factory = $this->accountFactory()->create();

        $account = Accounts::account()->find($factory->name);

        $this->assertNotNull($account);
        $this->assertEquals($factory->name, $account->name);
    }

    public function testFindNullAccount()
    {
        $account = Accounts::account()->find('not-found');

        $this->assertNull($account);
    }
}