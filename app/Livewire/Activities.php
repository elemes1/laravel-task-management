<?php

namespace App\Livewire;

use App\Models\ActivityLog;
use App\Models\Task;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class Activities extends Component implements HasForms, HasTable
{
    use InteractsWithTable, InteractsWithForms;

    public mixed $attachments;

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->attachments = $task->attachments;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ActivityLog::where(['subject_id' => $this->task->id]))
            ->columns([
                TextColumn::make('event'),
                TextColumn::make('description'),
                TextColumn::make('user.name'),
                TextColumn::make('created_at')->dateTime(),
            ]);
    }

    public function render()
    {
        return view('livewire.pages.plan.activities');
    }
}
