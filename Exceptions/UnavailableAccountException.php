<?php

namespace Maestro\Accounts\Exceptions;

use Maestro\Admin\Exceptions\BaseException;

class UnavailableAccountException extends BaseException
{
    const CODE = 'ACCEXC02';

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
        return 'Account no available';
    }
}