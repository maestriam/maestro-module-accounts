<?php

namespace Maestro\Accounts\Tests\Unit\Entities\Type;

use App\Models\User;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Entities\TypeEntity;
use Maestro\Accounts\Database\Models\Type;

class CreateTypeTest extends TestCase
{ 
    /*public function testCreateByName()
    {
        $entity = new TypeEntity();
        
        $name = $this->faker()->city() . time();
        $type = $entity->create($name);

        $this->assertInstanceOf(Type::class, $type); 
    }*/

    public function testCreateByObject()
    {
        $entity = new TypeEntity();
        $object = new User();
        
        $type = $entity->create($object);

        $this->assertInstanceOf(Type::class, $type); 
    }
}