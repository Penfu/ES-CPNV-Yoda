<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Practice as PracticeModel;

class Practice extends Component
{
    public PracticeModel $practice;

    public function render()
    {
        return view('livewire.practice');
    }
}
