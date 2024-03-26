<?php

namespace App\Livewire;

use Livewire\Component;

class Plan extends Component
{
    public function mount(\App\Models\Plan $plan)
    {

     }
    public function render()
    {
        return view('livewire.plan');
    }
}
