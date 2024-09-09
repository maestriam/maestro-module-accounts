<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\TypeFinder;

use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Exceptions\TypeNotFoundException;
use Maestro\Accounts\Support\Concerns\SearchesTypes;
use Maestro\Accounts\Tests\TestCase;

class FindOrFailTest extends TestCase
{
    use SearchesTypes;

    public function testFindType()
    {
        $mock = $this->makeMock();

        $type = $this->finder()->findOrFail($mock);
        
        $this->assertInstanceOf(Type::class, $type);
    }

    public function testFail()
    {
        $id = 1231232;

        $this->expectException(TypeNotFoundException::class);
        
        $this->finder()->findOrFail($id);
    }
}