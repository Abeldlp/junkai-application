<?php
//phpcs:disable
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TaskType;

class TaskTypeFactory extends Factory
{
    protected $model = TaskType::class;

    public function definition()
    {
        return [
            'type_name' => $this->faker->name()
        ];
    }
}
