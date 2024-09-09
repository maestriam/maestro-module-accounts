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

        $this->assertAccount($search, $found);
    }

    public function testFindByAccountable()
    {
        $search = $this->makeMock();
        $found  = $this->finder()->find($search);

        $this->assertAccount($search->account(), $found);
    }

    public function testFindByName()
    {
        $search = $this->makeMock()->account();
        $found  = $this->finder()->find($search->name);

        $this->assertAccount($search, $found);
    }

    private function assertAccount($search, $found)
    {
        $this->assertEquals($search->id, $found->id);
        $this->assertEquals($search->name, $found->name);
    }
}