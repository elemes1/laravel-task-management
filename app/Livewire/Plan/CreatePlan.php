<?php

namespace App\Livewire\Plan;

use App\Enums\PlanStatus;
use Exception;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePlan extends Component
{
    #[Validate('required')]
    public $title = '';

    #[Validate('required')]
    public $description = '';

    public function render()
    {
        return view('livewire.pages.plan.create-plan');
    }

    public function save()
    {
        $this->validate();
        $data = array_merge($this->only(['title', 'description']),
            ['status' => PlanStatus::OPEN, 'created_by' => auth()->id()]);
        try {
            $plan = \App\Models\Plan::create(
                $data
            );
            event(new \App\Events\PlanCreated($plan));

            session()->flash('status', 'Plan successfully created.');

            return $this->redirect('/plans/' . $plan->id);
        } catch (Exception $exception) {
            dd($exception);
        }
    }
}
