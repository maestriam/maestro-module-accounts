<?php
namespace Maestro\Accounts\Tests\Mocks;

use Illuminate\Foundation\Testing\WithFaker;
use Maestro\Accounts\Support\Concerns\HasAccount;
use Maestro\Accounts\Support\Contracts\Accountable;

class Entity implements Accountable
{
    use HasAccount, WithFaker;

    public int $id;

    public function __construct()
    {
        $this->id = rand(1, 99999999999);
    }

    public function name(): string
    {
        return $this->faker()->name();
    }

    public function find()
    {
        return $this;
    }
}