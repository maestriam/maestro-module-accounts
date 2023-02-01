<?php

namespace Maestro\Accounts\Exceptions;

use Maestro\Accounts\Exceptions\BaseException;

class TypeExistsException extends BaseException
{
    const CODE = '0103';

    /**
     * Define as configuração para enviar o exception
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->initialize();
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorMessage(): string
    {
        return 'The Type [[%s]] already exists.';
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorCode(): string
    {
        return self::CODE;
    }
}
