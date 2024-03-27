<?php

namespace App\Livewire\Plan;

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

class PlanList extends Component  implements HasForms, HasTable
{
    use InteractsWithTable,  InteractsWithForms;

    public function table(Table $table):Table
    {
        return $table
            ->query(Plan::where(['created_by' => auth()->id()]))
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('description'),
                TextColumn::make('created_at')->dateTime(),
                TextColumn::make('created_at')->dateTime(),
                IconColumn::make('status')
                    ->size(IconColumn\IconColumnSize::Medium)
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]) ->recordUrl(
                fn (Model $record): string => route('plan.edit', ['plan' => $record->id]),
            );
    }

    public function render()
    {
        return view('livewire.pages.plan.plan-list');
    }






}
