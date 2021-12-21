<?php
//phpcs:disable

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

use App\Models\TaskType;

class TaskTypeTest extends TestCase {
    use RefreshDatabase;

    public function test_it_can_get_tasks_types()
    {
        TaskType::factory()->count(20)->create();
        $collectionCount = TaskType::all()->toArray();
        $this->assertEquals(20, count($collectionCount));
    }

    public function test_it_can_save_task_type()
    {
        Session::start();

        $this->post('/task-type', [
            '_token' => csrf_token(),
            'type_name' => 'hello',
        ]);

        $lastTypeCreated = TaskType::orderBy('id', 'DESC')->first();
        $this->assertEquals('hello', $lastTypeCreated->type_name);
    }

    public function test_it_can_edit_task_type()
    {
        $taskType = TaskType::factory()->create();
        Session::start();

        $this->put('/task-type/'. $taskType->id , [
            '_token' => csrf_token(),
            'type_name' => 'changed'
        ]);

        $lastTypeCreated = TaskType::find($taskType->id);
        $this->assertEquals('changed', $lastTypeCreated->type_name);
    }

    public function test_it_can_delete_task_type()
    {
        $taskType = TaskType::factory()->create();

        Session::start();
        $this->delete('/task-type/'. $taskType->id, ['_token' => csrf_token()]);

        $lastCreatedType = TaskType::find($taskType->id);
        $this->assertNull($lastCreatedType);
    }
}
