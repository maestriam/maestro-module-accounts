<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\FindTypeService;

trait SearchesTypes 
{
    public function typeFinder()
    {
        return app()->make(FindTypeService::class);
    }
}