<?php
namespace Maestro\Accounts\Tests\Mocks;

use Illuminate\Foundation\Testing\WithFaker;
use Maestro\Accounts\Support\Abstraction\Accountable;

class Entity extends Accountable
{
    use WithFaker;

    private const TOKEN = '73b7d7fa141aa6769ec8bb7ed1';

    public function __construct()
    {
        $this->id = rand(1, 9999999);
    }

    public function token(): string
    {
        return self::TOKEN;
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