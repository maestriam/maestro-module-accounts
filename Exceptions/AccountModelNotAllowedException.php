<?php

namespace Maestro\Accounts\Exceptions;

use Maestro\Admin\Exceptions\BaseException;

class AccountModelNotAllowedException extends BaseException
{
    const CODE = 'ACCEXC03';

    public function __construct()
    {
        $this->initialize();
    }

    public function getErrorCode(): string
    {
        return 'Account model not allowed.';
    }

    public function getErrorMessage(): string
    {
        return self::CODE;
    }
}