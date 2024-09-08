<?php
namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Entities\Type;
use Maestro\Accounts\Support\Accounts;
use Maestro\Accounts\Tests\TestCase;

class CreateMockTest extends TestCase
{
    public function testCreateTypeMock()
    {
        $type = Accounts::factory()->type()->model();

        $this->assertInstanceOf(Type::class, $type);
    }

    public function testCreateAccountMock()
    {
        $account = Accounts::factory()->account()->model();

        $this->assertInstanceOf(Account::class, $account);
    }
}