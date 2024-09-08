<?php
namespace Maestro\Accounts\Database\Factories;

use Maestro\Accounts\Entities\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use Maestro\Accounts\Support\Concerns\CreatesTypes;

class TypeFactory extends Factory
{
    use CreatesTypes;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Type::class;

    /**
     * Retorna um tipo de conta fícitcio para realização
     * de testes. 
     *
     * @return Type
     */
    public function model() : Type
    {
        list($name, $auth) = array_values($this->definition());

        return $this->creator()->create($name, $auth);
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() : array
    {
        return [
            'name'  => $this->faker->word(),
            'auth'  => $this->faker->boolean(),
        ];
    }
}

