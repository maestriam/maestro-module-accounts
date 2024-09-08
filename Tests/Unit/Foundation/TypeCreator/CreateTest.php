<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\TypeCreator;

use App\Models\User;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Entities\TypeEntity;
use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Support\Concerns\CreatesTypes;
use Maestro\Accounts\Tests\Mocks\Entity;

class CreateTest extends TestCase
{ 
    use CreatesTypes;

    public function testCreateByObject()
    {
        $entity = new Entity();
        
        $type = $this->creator()->create($entity);

        $this->assertInstanceOf(Type::class, $type);
        $this->assertEquals($entity->token(), $type->token);
    }
}