<?php

namespace Maestro\Accounts\Exceptions;

use Maestro\Admin\Exceptions\BaseException;

class AccountNotFoundException extends BaseException
{
    const CODE = 'ACCEXC01';

    public function __construct()
    {
        $this->initialize();
    }

    public function getErrorCode(): string
    {
        return self::CODE;
    }

    public function getErrorMessage(): string
    {
        return 'Account not found.';
    }
}