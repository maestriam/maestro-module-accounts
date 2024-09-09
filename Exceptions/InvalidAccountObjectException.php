<?php

namespace Maestro\Accounts\Exceptions;

use Maestro\Accounts\Exceptions\BaseException;

class InvalidAccountObjectException extends BaseException
{
    const CODE = 'ACCEX0101';

    /**
     * Define as configuração para enviar o exception
     *
     * @param string $name
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorMessage(): string
    {
        return 'The object provided does not extends from Accountable class.';
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorCode(): string
    {
        return self::CODE;
    }
}
