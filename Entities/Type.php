<?php

namespace Maestro\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Maestro\Accounts\Database\Factories\TypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;

    protected $table = 'account_types';

    protected $fillable = [
        'name', 'auth'
    ];
    
    protected static function newFactory()
    {
        return TypeFactory::new();
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}