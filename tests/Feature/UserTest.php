<?php
//phpcs:disable

namespace Tests\Feature;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_users()
    {
        User::factory()->count(20)->create();
        $collectionCount = User::get()->toArray();
        $this->assertEquals(20, count($collectionCount));
    }

    public function test_it_can_save_users()
    {
        $this->withoutExceptionHandling();
        Session::start();

        $permission = Permission::factory()->create();

        $dataToSave = [
            '_token' => csrf_token(),
            'full_name' => 'test_name',
            'email' => 'abel@mail.com',
            'password' => 'password',
            'permission_id' => $permission->id

        ];

        $this->post('/users', $dataToSave);

        $this->assertDatabaseCount('users', 1);

    }

    public function test_it_can_edit_users()
    {
        $user = User::factory()->create();

        Session::start();
         
        $dataToUpdate = [
            '_token' => csrf_token(),
            'full_name' => 'test_full_name',
        ];

        $this->put('/users/' . $user->id, $dataToUpdate);
        $updatedUser = User::find($user->id);
        $this->assertEquals('test_full_name', $updatedUser->full_name);
    }

    public function test_it_can_delete_tasks()
    {
        $user = User::factory()->create();

        Session::start();

        $this->delete('/users/' . $user->id, ['_token' => csrf_token()]);

        $deletedUser = User::find($user->id);
        $this->assertNull($deletedUser);
    }

}
