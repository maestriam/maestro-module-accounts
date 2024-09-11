<?php

namespace Maestro\Accounts\Tests\Mocks;

class Third extends Entity
{
    const TOKEN = 'THIRD-MOCK';

    public function token(): string
    {
        return self::TOKEN;
    }
}