<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\RelationHandler;

use Maestro\Accounts\Support\Concerns\AccountRelationship;
use Maestro\Accounts\Tests\TestCase;

class RelateTest extends TestCase
{
    use AccountRelationship;

    public function testRelateAccount()
    {
        $user1 = $this->makeMock();
        $user2 = $this->makeMock();

        $response = $this->relation()->relate($user1, $user2);

        $this->assertTrue($response);
    }
}