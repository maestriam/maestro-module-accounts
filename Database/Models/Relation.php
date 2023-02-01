<?php

namespace Maestro\Accounts\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $table = 'account_relations';

    public function parent()
    {
        return $this->belongsTo(Account::class);
    }

    public function child()
    {
        return $this->belongsTo(Account::class);
    }
}