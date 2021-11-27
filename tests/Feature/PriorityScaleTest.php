<?php
//phpcs:disable
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\PriorityScale;
use Illuminate\Support\Facades\Session;

class PriorityScaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_priorities(){
        PriorityScale::factory()->count(20)->create();
        $collectionCount = PriorityScale::get()->toArray();
        $this->assertEquals(20, count($collectionCount));
    }

    public function test_it_can_save_priority_scale()
    {
        Session::start();

        $dataToSave = [
            '_token' => csrf_token(),
            'priority_name' => 'test'
        ];

        $this->post('/priorities', $dataToSave);

        $this->assertDatabaseCount('priority_scales', 1);

    }

    public function test_it_can_update_priority_scale()
    {
        Session::start();
        $created = PriorityScale::factory()->create();
        $dataToSave = [
            '_token' => csrf_token(),
            'priority_name' => 'test'
        ];

        $this->put('/priorities/' . $created->id, $dataToSave);
        
        PriorityScale::find($created->id)->update($dataToSave);
        $this->assertEquals('test', PriorityScale::find($created->id)->priority_name);
        
    }

    public function test_it_can_delete_priority_scale()
    {
        $prio = PriorityScale::factory()->create();

        Session::start();

        $this->delete('/priorities/' . $prio->id, ['_token' => csrf_token()]);

        $deletedPrio = PriorityScale::find($prio->id);
        $this->assertNull($deletedPrio);
    }
}
