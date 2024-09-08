<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\TypeHandler;

trait HandlesTypes
{
    public function type() : TypeHandler
    {
        return app()->make(TypeHandler::class);
    }
}
