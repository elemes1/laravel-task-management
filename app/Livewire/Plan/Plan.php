<?php

namespace App\Livewire\Plan;

use App\Enums\TaskStatus;
use App\Models\Attachment;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Plan extends Component
{
    use WithFileUploads;

    public \App\Models\Plan $plan;

    public \App\Models\Task $currentTask;

    #[Validate('max:5024')]
    public $attachment;



    public $attachmentFileName;

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
        $this->authorize('view', $plan);
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
            $task->attachment_count = $task?->attachments?->count();
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
            'due_date' => 'sometimes|required|date',
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
        $task = Task::findOrFail($taskData['id']);
        $this->authorize('update', $task);
        $validatedData = collect($validator->validated())->except(['id'])->toArray();
        $task->update($validatedData);
        $this->loadTasks();
    }

    #[On('task-deleted')]
    public function deleteTask($taskData)
    {

        $validator = Validator::make($taskData, [
            'id' => 'required|exists:tasks,id',
        ]);
        $task = Task::findOrFail($taskData['id']);
        $this->authorize('delete', $task);
        if ($validator->fails()) {
            // Handle failed validation
            return;
        }
        $task->delete();
        $this->loadTasks(); // Reload tasks
    }


    #[On('task-editing')]
    public function setCurrentTaskContext(Task $taskData)
    {
        $this->currentTask = $taskData;
    }

    public function viewTaskActivities($taskId)
    {
        return $this->redirectRoute('activities.all', $taskId);
    }


    public function updatedAttachment()
    {
        $url  = $this->attachment->store(path: 'attachments');
        $attachment = new Attachment();
        $attachment->file_name = $this->attachment->getClientOriginalName();
        $attachment->file_path = $url;
        $attachment->mime_type = $this->attachment->getMimeType();
        $attachment->uploaded_by =  auth()->id();
        $attachment->task_id = $this->currentTask->id;
        $attachment->save();
        $this->attachmentFileName = $this->attachment->getFilename();
        $this->attachment = null ;
    }

}
