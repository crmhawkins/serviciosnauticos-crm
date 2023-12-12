<?php

namespace App\Http\Livewire\Club;

use Livewire\Component;
use App\Models\Club;

class IndexComponent extends Component
{
    public $clubes;

    public function mount()
    {
        $this->clubes = Club::all();
    }
    public function render()
    {
        return view('livewire.club.index-component');
    }

}
