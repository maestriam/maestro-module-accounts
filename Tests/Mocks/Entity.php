<?php
namespace Maestro\Accounts\Tests\Mocks;

use Illuminate\Foundation\Testing\WithFaker;
use Maestro\Accounts\Support\Concerns\HasAccount;

class Entity
{
    use HasAccount;

    public int $id;

    public function __construct()
    {
        $this->id = rand(1, 99999999999);
    }
}