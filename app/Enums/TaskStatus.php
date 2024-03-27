<?php
namespace App\Enums;

enum TaskStatus: string
{
    case OPEN = 'open';
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

}

