<?php

namespace Maestro\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'account_types';

    protected $fillable = [
        'name', 'auth'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
