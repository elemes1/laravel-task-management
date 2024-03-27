<?php

namespace App\Livewire\Plan;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Component;

class Plan extends Component
{
    public \App\Models\Plan $plan;

    /**
     * @var Task[]
     */

    public array $tasks;

    /**
     * @var TaskStatus[]
     */
    public array $boards;

    public function mount(\App\Models\Plan $plan)
    {
        $this->plan = $plan;
        $this->boards = array_column(TaskStatus::cases(), 'value');
        $this->loadTasks();
    }

    public function render()
    {
        return view('livewire.pages.plan.plan');
    }

    public function loadTasks()
    {
        $this->tasks = $this->plan?->tasks->map(function ($task) {
            $task->edit = false;

            return $task;
        })->toArray();
    }

    #[On('task-created')]
    public function createTasks($taskData)
    {
        $validator = Validator::make($taskData, [
            'title' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'due_date' => 'sometimes|required|date'
        ]);
        if ($validator->fails()) {
            // Handle failed validation
            return;
        }
        Task::create(array_merge(
            ['plan_id' => $this->plan->id]
            , $validator->validated()
        ));
        $this->loadTasks(); // Reload tasks
    }

    #[On('task-updated')]
    public function updateTask($taskData, $forceReload = false)
    {
        $validator = Validator::make($taskData, [
            'id' => 'required|exists:tasks,id',
            'title' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'due_date' => 'sometimes|required|date',
        ]);
        if ($validator->fails()) {
            // Handle failed validation
            return;
        }
        $validatedData = collect($validator->validated())->except(['id'])->toArray();

        Task::findOrFail($taskData['id'])->update($validatedData);

        $this->loadTasks();

    }

    #[On('task-deleted')]
    public function deleteTask($taskData)
    {
        $validator = Validator::make($taskData, [
            'id' => 'required|exists:tasks,id',
        ]);
        if ($validator->fails()) {
            // Handle failed validation
            return;
        }
        Task::findOrFail($taskData['id'])->delete();
        $this->loadTasks(); // Reload tasks
    }

    public function viewTaskActivities($taskId)
    {
        return $this->redirectRoute('activities.all', $taskId);
    }



}
