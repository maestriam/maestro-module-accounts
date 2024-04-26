<?php

namespace Maestro\Accounts\Tests\Mocks;

use Maestro\Accounts\Support\Concerns\HasAccount;

class EntityMock
{
    use HasAccount;

    public int $id;

    public function __construct()
    {
        $this->id = rand(1, 100000);
    }

    public function find()
    {
        return $this;
    }
}