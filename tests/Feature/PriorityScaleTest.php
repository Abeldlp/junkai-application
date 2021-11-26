<?php
//phpcs:disable
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\PriorityScale;

class PriorityScaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_save_priority_scale()
    {
        PriorityScale::factory()->create();
        $this->assertDatabaseCount('priority_scales', 1);
    }

    public function test_it_can_update_priority_scale()
    {
        $newName = 'test';
        $prio = PriorityScale::factory()->create();
        $this->assertNotEquals($prio->priority_name, $newName);
        $prio->update(['priority_name' => $newName]);
        $this->assertEquals($newName, $prio->priority_name);
    }

    public function test_it_can_delete_priority_scale()
    {
        $prio = PriorityScale::factory()->create();
        $this->assertDatabaseCount('priority_scales', 1);
        $prio->delete();
        $this->assertDatabaseCount('priority_scales', 0);
    }
}
