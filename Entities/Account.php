<?php

namespace Maestro\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
