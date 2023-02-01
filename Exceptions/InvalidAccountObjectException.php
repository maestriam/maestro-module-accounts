<?php

namespace Maestro\Accounts\Exceptions;

use Maestro\Accounts\Exceptions\BaseException;

class InvalidAccountObjectException extends BaseException
{
    const CODE = '0101';

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
        return 'The object provided is invalid. Check if accountName and password was setted or class use HasAccount trait.';
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorCode(): string
    {
        return self::CODE;
    }
}
