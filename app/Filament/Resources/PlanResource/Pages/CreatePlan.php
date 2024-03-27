<?php

namespace App\Filament\Resources\PlanResource\Pages;

use App\Enums\PlanStatus;
use App\Filament\Resources\PlanResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePlan extends CreateRecord
{
    protected static string $resource = PlanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        $data['status'] = PlanStatus::OPEN;

        return $data;
    }
}
