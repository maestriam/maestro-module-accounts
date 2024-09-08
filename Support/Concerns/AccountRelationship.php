<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\RelateAccountsService;

trait AccountRelationship
{
    /**
     * Undocumented function
     *
     * @return RelateAccountsService
     */
    private function relation() : RelateAccountsService
    {
        return app(RelateAccountsService::class);
    }
}