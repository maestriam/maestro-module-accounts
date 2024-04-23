<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Database\Models\Account;
use Maestro\Accounts\Exceptions\AccountNotFoundException;
use Maestro\Accounts\Support\Facades\Accounts;
use Maestro\Accounts\Tests\Mocks\UserMock;

class FindOrFailAccountTest extends TestCase
{
    public function testFindOrFailByName()
    {
        $account = $this->accountFactory()->create();

        $found = Accounts::account()->findOrFail($account->name);

        $this->assertFoundIsSuccess($found, $account);
    }

    public function testFindOrFailById()
    {
        $account = $this->accountFactory()->create();

        $found = Accounts::account()->findOrFail($account->id);

        $this->assertFoundIsSuccess($found, $account);
    }

    public function testFindOrFailByEntity()
    {
        $user = new UserMock();

        $account = Accounts::account()->create($user, 'account-name');

        $found = Accounts::account()->findOrFail($user);

        $this->assertFoundIsSuccess($found, $account);
    }

    public function testException()
    {
        $this->expectException(AccountNotFoundException::class);

        Accounts::account()->findOrFail('n0t-exi$t$');
    }

    private function assertFoundIsSuccess($found, $account)
    {
        $this->assertInstanceOf(Account::class, $found);
        
        $this->assertEquals($account->name, $found->name);
    }
}