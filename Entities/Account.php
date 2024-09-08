<?php

namespace Maestro\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Maestro\Accounts\Database\Factories\AccountFactory;

class Account extends Model
{
    use HasFactory;
    
    protected static function newFactory()
    {
        return AccountFactory::new();
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
