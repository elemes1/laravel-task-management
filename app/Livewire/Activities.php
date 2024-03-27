<?php

namespace App\Livewire;

use App\Models\ActivityLog;
use App\Models\Plan;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Activities extends Component  implements HasForms, HasTable
{
    use InteractsWithTable,  InteractsWithForms;

    public function mount(\App\Models\Task $task)
    {
        $this->task = $task;

    }

    public function table(Table $table):Table
    {
        return $table
            ->query(ActivityLog::where(['subject_id' => $this->task->id]))
            ->columns([
                TextColumn::make('event'),
                TextColumn::make('description'),
                TextColumn::make('caused_by')->dateTime(),
                TextColumn::make('created_at')->dateTime(),
            ]);
    }

    public function render()
    {
        return view('livewire.pages.plan.activities');
    }






}
