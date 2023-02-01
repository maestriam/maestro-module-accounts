<?php
 
namespace  Maestro\Accounts\Http\Rules;
 
use Illuminate\Contracts\Validation\Rule;
use Maestro\Accounts\Support\Facades\Accounts;

class UniqueAccount implements Rule
{    
    public function passes($attributes, $value)
    {
        $ret = Accounts::account()->isExists($value) ? false : true;

        return $ret;
    }

    public function message()
    {
        return 'The :attribute already exists.';
    }
}