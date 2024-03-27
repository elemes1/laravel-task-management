<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Livewire\Component;

class TaskModal extends Component
{
    public $showModal = false;

    public $task;

    public $isEdit = false;

    protected $listeners = ['openModal' => 'handleOpenModal'];

    public function mount()
    {
        $this->task = new Task();
    }

    public function handleOpenModal($taskId = null)
    {
        if ($taskId) {
            $this->task = Task::find($taskId);
            $this->isEdit = true;
        } else {
            $this->task = new Task();
            $this->isEdit = false;
        }
        $this->showModal = true;
    }

    public function saveTask()
    {
        $this->validate([
            'task.title' => 'required|string|max:255',
            'task.description' => 'required|string',
        ]);

        $this->task->save();

        $this->emitTo('task-board', 'refreshBoard');
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.pages.tasks.task-modal');
    }
}
