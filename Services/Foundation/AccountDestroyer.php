<?php


namespace Maestro\Accounts\Services\Foundation;

use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Support\Abstraction\Accountable;
use Maestro\Accounts\Support\Concerns\DeletesAccounts;
use Maestro\Accounts\Support\Concerns\SearchesAccounts;

class AccountDestroyer
{
    use SearchesAccounts;

    public function delete(string|int|Accountable $target)
    {    
        $account = $this->finder()->find($target);

        if ($account == null) return null;

        return $account->delete();
    }
}