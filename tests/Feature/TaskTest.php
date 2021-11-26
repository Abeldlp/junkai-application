<?php
//phpcs:disable
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{

    use RefreshDatabase;

    /* public function test_it_can_save_tasks() */
    /* { */
    /*     (new Task())->create([ */
    /*         'task_type_id' => 1, */
    /*         'owner_id' => 1, */
    /*         'created_by' => 1, */
    /*         'task_priority' => 1, */
    /*         'completed' => false, */
    /*     ]); */

    /*     $this->assertDatabaseCount('tasks', 1); */
    /* } */

    /* public function test_it_can_post_and_save_tasks() */
    /* { */
    /*     $this->withoutExceptionHandling(); */
    /*     $dataToSave = [ */
    /*         'task_type_id' => 1, */
    /*         'owner_id' => 1, */
    /*         'created_by' => 1, */
    /*         'task_priority' => 1, */
    /*         'completed' => false, */
    /*     ]; */

    /*     $this->post('/tasks', $dataToSave); */

    /*     $task = (new Task())->orderBy('id', 'DESC')->first(); */
    /*     dd($task); */

    /*     /1* $this->assertEquals(1, $task->owner_id); *1/ */
    /* } */
}
