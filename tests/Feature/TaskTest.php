<?php
//phpcs:disable
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

use App\Models\Task;
use App\Models\PriorityScale;
use App\Models\TaskType;
use App\Models\User;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_save_tasks()
    {
        Task::factory()->create();

        $this->assertDatabaseCount('tasks', 1);
    }

    public function test_it_can_post_and_save_tasks()
    {
        $this->withoutExceptionHandling();

        $type = TaskType::factory()->create();
        $prio = PriorityScale::factory()->create();
        $user = User::factory()->create();
        $receiver = User::factory()->create();

        Session::start();

        $dataToSave = [
            '_token' => csrf_token(),
            'task_type_id' => $type->id,
            'owner_id' => $user->id,
            'created_by' => $receiver->id,
            'task_priority' => $prio->id,
            'completed' => false,
        ];

        $this->post('/tasks', $dataToSave);
        $lastTask = Task::orderBy('id', 'DESC')->first();
        $this->assertEquals($lastTask->owner->full_name, $user->full_name);
    }
}
