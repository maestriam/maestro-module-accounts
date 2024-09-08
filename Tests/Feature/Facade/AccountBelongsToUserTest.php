<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Users\Support\Users;
use Maestro\Accounts\Support\Accounts;

class AccountBelongsToUserTest extends TestCase
{
    public function testBelongsTo()
    {
        $entity = $this->makeMock();
        
        $name = $entity->account()->name;
        
        $belongs = Accounts::account()->belongsTo($entity, $name);

        $this->assertTrue($belongs);
    }

    public function testBelongsToNullUser()
    {
        $belongs = Accounts::account()->belongsTo(null, 'null-user');

        $this->assertFalse($belongs);
    }
}