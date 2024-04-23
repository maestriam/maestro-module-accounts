<?php

namespace Maestro\Accounts\Support\Concerns;

use Maestro\Accounts\Services\Foundation\StoreTypeService;

trait StoresTypes
{
    public function typeCreator()
    {
        return app()->make(StoreTypeService::class);
    }
}