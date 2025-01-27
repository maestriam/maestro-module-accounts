<?php

namespace Maestro\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $table = 'account_relations';

    protected $fillable = [
        'child_id', 'parent_id', 
    ];

    public function parent()
    {
        return $this->belongsTo(Account::class);
    }

    public function child()
    {
        return $this->belongsTo(Account::class);
    }
}