<?php

namespace App\Livewire\Plan;

use App\Enums\PlanStatus;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePlan extends Component
{
    public function render()
    {
        return view('livewire.pages.plan.create-plan');
    }

    #[Validate('required')]
    public $title = '';

    #[Validate('required')]
    public $description = '';



    public function save()
    {
        $this->validate();
        $data =  array_merge($this->only(['title', 'description']), ['status'=> PlanStatus::OPEN, 'created_by' => auth()->id()]);
        try {
            $plan = \App\Models\Plan::create(
                $data
            );
            session()->flash('status', 'Plan successfully created.');
            return $this->redirect('/plans/'.$plan->id);
        }catch (\Exception $exception){

        }

    }

}
