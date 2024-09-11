<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Support\Accounts;
use Maestro\Accounts\Tests\Mocks\Primary;
use Maestro\Accounts\Tests\Mocks\Secondary;
use Maestro\Accounts\Tests\TestCase;

class GetEntityFacadeTest extends TestCase
{
    public function testGetEntity()
    {
        $primary = $this->makeMock(true, Primary::class); 
        $second  = $this->makeMock(true, Secondary::class);

        $found1 = Accounts::account()->finder()->entity($primary->account()->id);
        $found2 = Accounts::account()->finder()->entity($second->account()->id);

        $this->assertInstanceOf(Primary::class, $found1);
        $this->assertInstanceOf(Secondary::class, $found2);
    }
}