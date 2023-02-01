<?php
namespace Maestro\Accounts\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Maestro\Accounts\Database\Models\Account;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'       => $this->faker->username(),
            'entity_id'  => $this->faker->randomDigit()
        ];
    }
}

