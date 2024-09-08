<?php

namespace Maestro\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Maestro\Admin\Support\Concerns\CamelAttributes;

class Account extends Model
{
    use CamelAttributes;

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
