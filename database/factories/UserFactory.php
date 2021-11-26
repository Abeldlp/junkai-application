<?php
//phpcs:disable
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Permission;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'email' => $this->faker->email,
            'password' =>   $this->faker->password(6, 20),
            'permission_id' => Permission::factory()->create()->id,
        ];
    }
}
