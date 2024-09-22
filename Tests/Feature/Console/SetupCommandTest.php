<?php

namespace Maestro\Accounts\Tests\Feature\Console;

use Illuminate\Support\Facades\Artisan;
use Maestro\Accounts\Tests\TestCase;

class SetupCommandTest extends TestCase
{
    public function testCommand()
    {
        $this->artisan("accounts:install")->assertOk();   
    }
}