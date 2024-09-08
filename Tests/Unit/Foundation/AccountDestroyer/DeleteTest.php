<?php
namespace Maestro\Accounts\Tests\Unit\Foundation\AccountDestroyer;

use Maestro\Accounts\Support\Concerns\DeletesAccounts;
use Maestro\Accounts\Tests\TestCase;

class DeleteTest extends TestCase
{
    use DeletesAccounts;

    public function testDelete()
    {
        $target = $this->makeMock();

        $response = $this->destroyer()->delete($target);

        $this->assertTrue($response);
    }
}