<?php
 
namespace  Maestro\Accounts\Http\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;
use Maestro\Accounts\Support\Facades\Accounts;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Validator;

class UniqueAccount
{    
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    public function validate(string $attribute, mixed $value, mixed $fail, Validator $validator)
    {
        $exits = Accounts::account()->isExists($value);

        if (! $exits) return true;

        $user = $validator->getData()['entity'] ?? null;

        $belongs = Accounts::account()->belongsTo($user, $value);

        return ($belongs == true) ? true : false;
    }
}