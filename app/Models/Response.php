<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'description',
        'filename'
    ];

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
