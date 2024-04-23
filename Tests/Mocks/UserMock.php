<?php

namespace Maestro\Accounts\Tests\Mocks;

use Maestro\Accounts\Support\Concerns\HasAccount;

class UserMock
{
    use HasAccount;

    public int $id = 1;
}