<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\TypeFinder;

use Maestro\Accounts\Support\Concerns\CreatesTypes;
use Maestro\Accounts\Support\Concerns\RetrivesClassName;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Support\Concerns\SearchesTypes;

class FindTest extends TestCase
{
    use SearchesTypes, 
        CreatesTypes,
        RetrivesClassName;

    public function testFindByAccountable()
    {
        list($mock, $type) = $this->getType();

        $found = $this->finder()->findByAccountable($mock);

        $this->assertEquals($type->id, $found->id);
    }

    public function testFindBySignature()
    {   
        list($mock, $type) = $this->getType();

        $token = $mock->token();
        $class = $this->getClassName($mock);

        $found1 = $this->finder()->findBySignature($token);
        $found2 = $this->finder()->findBySignature($class);

        $this->assertEquals($type->id, $found1->id);
        $this->assertEquals($type->id, $found2->id);
    }

    public function testFindById()
    {
        list($mock, $type) = $this->getType();

        $found = $this->finder()->findById($type->id);

        $this->assertEquals($type->id, $found->id);
    }

    public function testFindUsingAccountable()
    {
        list($mock, $type) = $this->getType();

        $found = $this->finder()->find($mock);

        $this->assertEquals($type->id, $found->id);
    }

    public function testFindUsingSignature()
    {
        list($mock, $type) = $this->getType();

        $found1 = $this->finder()->find($mock->token());
        $found2 = $this->finder()->find($mock);

        $this->assertEquals($type->id, $found1->id);
        $this->assertEquals($type->id, $found2->id);
    }
    
    public function testFindUsingId()
    {
        list($mock, $type) = $this->getType();
        
        $found = $this->finder()->find($type->id);
        
        $this->assertEquals($type->id, $found->id);
    }

    private function getType()
    {
        $mock  = $this->makeMock(false);
        $type  = $this->creator()->create($mock);

        return [$mock, $type];
    }
}