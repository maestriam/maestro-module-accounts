<?php

namespace Maestro\Accounts\Tests\Feature\Console;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Entities\Relation;
use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Tests\TestCase;

class InstallCommandTest extends TestCase
{
    public function testCommand()
    {
        $this->artisan("accounts:install")->assertOk(); 
        
        $type     = new Type();
        $account  = new Account();
        $relation = new Relation();
        
        $this->assertTrue(Schema::hasTable($type->getTable()));
        $this->assertTrue(Schema::hasTable($account->getTable()));
        $this->assertTrue(Schema::hasTable($relation->getTable()));
    }
}