<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Sector;
use Livewire\Component;

class TaskForm extends Component
{
    public $sectorId, $userId, $employees;
    public $user_id;
    public $name;
    public $description;
    public $deadline;
    public $priority;
    public $status;
    public $file;

    public function render()
    {
        $sectors = Sector::all();
        return view('livewire.task-form', [
            'sectors' => $sectors,
        ]);
    }

    public function mount(){
        $this->sectorId = 1;
        $this->employees = User::where('sector_id', $this->sectorId)->where('id', '<>', 1)->get();
    }
    public function updatedSectorId(){
        $this->employees = NULL;
        $this->employees = User::where('sector_id', $this->sectorId)->get();
        $this->emit('changedSector', [
            'employees' => $this->employees
        ]);
    }
}
