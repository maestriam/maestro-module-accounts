<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\TypeFinder;

use Maestro\Accounts\Support\Concerns\RetrivesClassName;
use Maestro\Accounts\Support\Concerns\SearchesTypes;
use Maestro\Accounts\Tests\TestCase;

class ExistsTest extends TestCase
{
    use SearchesTypes,
        RetrivesClassName;

    public function testExistsUsingAccountable()
    {
        $mock = $this->makeMock();

        $exists = $this->finder()->exists($mock);

        $this->assertTrue($exists);
    }

    public function testExistsUsingSignature()
    {
        $mock = $this->makeMock();

        $token = $mock->token();
        $class = $this->getClassName($mock);

        $exists1 = $this->finder()->exists($token);
        $exists2 = $this->finder()->exists($class);

        $this->assertTrue($exists1);
        $this->assertTrue($exists2);
    }

    public function testExistsById()
    {
        $mock = $this->makeMock()->account()->id;

        $exists = $this->finder()->exists($mock);

        $this->assertTrue($exists);
    }
}