<?php

namespace App\Livewire\Utility;

use Livewire\Component;

class FlashMessages extends Component
{
    public $message;

    protected $listeners = ['flash' => 'setFlashMessage'];

    public function render()
    {
        return view('livewire.utility.flash-messages');
    }

    public function setFlashMessage($message)
    {
        $this->message = $message;

        // Reset the message after a few seconds
        $this->dispatchBrowserEvent('flash-message-reset');
    }
}
