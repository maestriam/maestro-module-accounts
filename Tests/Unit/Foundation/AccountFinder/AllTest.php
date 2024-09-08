<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\AccountFinder;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Support\Concerns\SearchesAccounts;

class AllTest extends TestCase
{
    use SearchesAccounts;

    public function testAll()
    {       
        $this->makeAccount();

        $accounts = $this->finder()->all();

        $this->assertCount(1, $accounts);
    }
}