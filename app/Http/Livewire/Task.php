<?php

namespace App\Http\Livewire;

use App\Models\Sector;
use Livewire\Component;


class Task extends Component
{
    public $sectorId, $userId;
    public $sectors, $employees;

    public function render()
    {
        $this->sectors = Sector::all();
        $tasks = \App\Models\Task::where('creator_id', 1)->where('status', '<>', "Completed")->orderBy('deadline', 'ASC')->paginate(20);
        return view('livewire.task', [
            'tasks' => $tasks
        ]);
    }

    public function mount(){
        $this->sector_id = NULL;
        $this->user_id = NULL;
    }
}
