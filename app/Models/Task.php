<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function priority()
    {
        return $this->belongsTo(PriorityScale::class, 'task_priority', 'id');
    }

    public function type()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id', 'id');
    }
}
