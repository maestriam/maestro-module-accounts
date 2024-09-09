<?php

namespace maestro\Accounts\Exceptions;

use Maestro\Accounts\Exceptions\BaseException;

class TokenNotFoundException extends BaseException
{
    const CODE = 'ACCEX0102';

    public function __construct(object $instance)
    {
        $class = get_class($instance);

        $this->initialize($class);
    }

    public function getErrorCode(): string
    {
        return self::CODE;        
    }

    public function getErrorMessage(): string
    {
        return 'Token not found in the class [%s].';
    }
}