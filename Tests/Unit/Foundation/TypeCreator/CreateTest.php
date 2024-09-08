<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\TypeCreator;

use App\Models\User;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Entities\TypeEntity;
use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Support\Concerns\CreatesTypes;

class CreateTest extends TestCase
{ 
    use CreatesTypes;

    /*public function testCreateByName()
    {
        $entity = new TypeEntity();
        
        $name = $this->faker()->city() . time();
        $type = $entity->create($name);

        $this->assertInstanceOf(Type::class, $type); 
    }*/

    public function testCreateByObject()
    {
        $object = new User();
        
        $type = $this->creator()->create($object);

        $this->assertInstanceOf(Type::class, $type); 
    }
}