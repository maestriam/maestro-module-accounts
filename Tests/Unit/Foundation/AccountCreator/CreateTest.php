<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\AccountCreator;

use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Support\Concerns\CreatesAccounts;

class CreateTest extends TestCase
{
    use CreatesAccounts;

    public function testCreateAccount()
    {
        $user = $this->makeUser();
        $name = 'account-name-to-my-user';

        $account = $this->creator()->create($user, $name);

        $this->assertInstanceOf(Account::class, $account);
    }
}
