<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Sidebar extends Component
{

    public $role;

    public function mount()
    {
        $this->role = auth()->user()->role;
    }

    public function render()
    {
        return view('livewire.components.sidebar');
    }
}
