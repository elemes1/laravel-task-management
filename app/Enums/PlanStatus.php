<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PlanStatus: string implements HasLabel
{
    case OPEN = 'open';

    case ARCHIVED = 'archived';

    // Add other statuses as needed
    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::OPEN => 'heroicon-o-clock',
            self::ARCHIVED => 'heroicon-o-check-circle'
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::OPEN => 'success',
            self::ARCHIVED => 'gray',
        };
    }
}

