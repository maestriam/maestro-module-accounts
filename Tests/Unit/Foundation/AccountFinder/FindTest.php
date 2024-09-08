<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\AccountFinder;

use Maestro\Accounts\Support\Concerns\SearchesAccounts;
use Maestro\Accounts\Tests\TestCase;

class FindTest extends TestCase
{
    use SearchesAccounts;

    public function testFindById()
    {
        $search = $this->makeMock()->account();
        $found  = $this->finder()->find($search->id);

        $this->assertEquals($search->id, $found->id);
        $this->assertEquals($search->name, $found->name);
    }
}