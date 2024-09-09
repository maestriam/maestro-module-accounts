<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\TypeCreator;

use stdClass;
use TypeError;
use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Tests\Mocks\Entity;
use Maestro\Accounts\Support\Concerns\CreatesTypes;
use Maestro\Accounts\Exceptions\TypeExistsException;

class CreateTest extends TestCase
{ 
    use CreatesTypes;

    public function testCreateTypeByAccountable()
    {
        $entity = new Entity();
        $type = $this->creator()->create($entity);

        $this->assertInstanceOf(Type::class, $type);
        $this->assertEquals($entity->token(), $type->token);
    }

    public function testCreateDuplicate()
    {
        $entity = new Entity();
        
        $type1 = $this->creator()->create($entity);
        $type2 = $this->creator()->create($entity);        

        $this->assertEquals($type1->id, $type2->id);
        $this->assertEquals($type1->token, $type2->token);
    }

    public function testCreateTypeByObject()
    {
        $entity = new stdClass();
        
        $this->expectException(TypeError::class);

        /**
         * @disregard P1006 Supressão de erro de tipagem. 
         */
        $this->creator()->create($entity);
    }
}