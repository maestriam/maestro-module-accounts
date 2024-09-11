<?php
namespace Maestro\Accounts\Database\Factories;

use Maestro\Accounts\Entities\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use Maestro\Accounts\Support\Abstraction\Accountable;
use Maestro\Accounts\Support\Concerns\CreatesTypes;
use Maestro\Accounts\Tests\Mocks\Entity;

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
    public function model(Accountable $entity = null, bool $auth = null) : Type
    {
        $default = $this->definition();

        $auth   = $auth ?? $default['auth'];
        $entity = $entity ?? $default['entity'];

        return $this->creator()->create($entity, $auth);
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() : array
    {
        return [
            'entity' => new Entity(),
            'auth'   => $this->faker->boolean(),
        ];
    }
}

