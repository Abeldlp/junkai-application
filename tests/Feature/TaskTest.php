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

    public function test_it_can_get_tasks(){
        Task::factory()->count(20)->create();
        $collectionCount = Task::get()->toArray();
        $this->assertEquals(20, count($collectionCount));
    }

    public function test_it_can_save_tasks()
    {
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

    public function test_it_can_edit_tasks()
    {
        $task = Task::factory()->create();
        Session::start();
        $dataToUpdate = [
            '_token' => csrf_token(),
            'completed' => true,
        ];

        $this->assertFalse($task->completed);
        $url = '/tasks/'.$task->id;
        $this->put($url, $dataToUpdate);
        $updatedTask = Task::find($task->id);
        $this->assertEquals(1, $updatedTask->completed);
    }

    public function test_it_can_delete_tasks()
    {
        $this->withoutExceptionHandling();
        $task = Task::factory()->create();

        Session::start();

        $url = '/tasks/'.$task->id;
        $this->delete($url, ['_token' => csrf_token()]);

        $deletedTask = Task::find($task->id);
        $this->assertNull($deletedTask);
    }
}
