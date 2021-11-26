<?php
//phpcs:disable
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'id', 'task_type_id');
    }
}
