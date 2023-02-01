<?php

namespace Maestro\Accounts\Exceptions;

use Maestro\Accounts\Exceptions\BaseException;

class TypeNotFoundException extends BaseException
{
    const CODE = '0102';

    /**
     * Define as configuração para enviar o exception
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->initialize($name);
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
