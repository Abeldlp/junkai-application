<?php
//phpcs:disable
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

use App\Models\TaskType;
use App\Models\User;
use App\Models\PriorityScale;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'task_type_id' => TaskType::factory()->create()->id,
            'owner_id' => User::factory()->create()->id,
            'created_by' => User::factory()->create()->id,
            'task_priority' => PriorityScale::factory()->create()->id,
            'completed' => false
        ];
    }
}
