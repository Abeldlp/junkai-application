<?php
//phpcs:disable
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'permission_id',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function permission()
    {
        return $this->hasOne(Permission::class);
    }
}
