<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\TypeFinder;

use Maestro\Accounts\Support\Concerns\SearchesTypes;
use Maestro\Accounts\Tests\TestCase;

class AllTest extends TestCase
{
    use SearchesTypes;

    public function testAll()
    {
        $types = $this->search()->all();

        $this->assertCount(1, $types);
    }
}