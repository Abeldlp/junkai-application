<?php
//phpcs:disable
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/* use Database\Factories\PriorityScaleFactory; */

class PriorityScale extends Model
{
    use HasFactory;

    protected $fillable = [
        'priority_name'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'id', 'task_priority');
    }
}
