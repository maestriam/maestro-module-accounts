<?php

namespace Maestro\Accounts\Tests\Mocks;

class Secondary extends Entity
{
    const TOKEN = 'SECONDARY-MOCK';

    public function token(): string
    {
        return self::TOKEN;
    }
}