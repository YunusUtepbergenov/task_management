<?php

namespace App\Models;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sector extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
