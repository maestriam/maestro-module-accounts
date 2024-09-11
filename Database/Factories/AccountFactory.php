<?php
namespace Maestro\Accounts\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Maestro\Accounts\Entities\Account;
use Maestro\Accounts\Support\Abstraction\Accountable;
use Maestro\Accounts\Support\Concerns\CreatesAccounts;
use Maestro\Accounts\Support\Concerns\CreatesTypes;
use Maestro\Accounts\Tests\Mocks\Entity;

class AccountFactory extends Factory
{
    use CreatesAccounts;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Retorna uma instância de uma conta para a realização de testes. 
     *
     * @param Accountable|null $entity
     * @param string|null $name
     * @return Account
     */
    public function model(Accountable $entity = null, string $name = null) : Account
    {
        $default = $this->definition();

        $name   = $name ?? $default['name'];
        $entity = $entity ?? $default['entity'];
        
        return $this->creator()->create($entity, $name);
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'entity' => new Entity(),
            'name'   => $this->faker->username(),
        ];
    }
}

