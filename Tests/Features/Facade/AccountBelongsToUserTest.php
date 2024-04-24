<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Users\Support\Facade\Users;
use Maestro\Accounts\Support\Facades\Accounts;

class AccountBelongsToUserTest extends TestCase
{
    public function testBelongsTo()
    {
        $user = $this->makeEntityWithAccount();
        
        $name = $user->account()->name;
        
        $belongs = Accounts::account()->belongsTo($user, $name);

        $this->assertTrue($belongs);
    }

    public function testBelongsToNullUser()
    {
        $belongs = Accounts::account()->belongsTo(null, 'null-user');

        $this->assertFalse($belongs);
    }
}