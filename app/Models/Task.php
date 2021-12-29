<?php

namespace App\Models;

use App\Models\User;
use App\Models\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'creator_id',
        'name',
        'description',
        'status',
        'priority',
        'file',
        'deadline'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function response(){
        return $this->hasOne(Response::class);
    }
}
