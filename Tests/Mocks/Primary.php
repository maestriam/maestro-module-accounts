<?php

namespace Maestro\Accounts\Tests\Mocks;

class Primary extends Entity
{
    const TOKEN = 'PRIMARY-MOCK';

    public function token(): string
    {
        return self::TOKEN;
    }
}