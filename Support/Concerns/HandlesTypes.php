<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Support\Facades\TypeFacade;

trait HandlesTypes
{
    public function type() : TypeFacade
    {
        return app()->make(TypeFacade::class);
    }
}
