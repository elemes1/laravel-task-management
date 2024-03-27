<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Task extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;


    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }


    public function attachments() {
        return $this->hasMany(Attachment::class);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->dontLogIfAttributesChangedOnly(['created_at', 'updated_at'])
            ->logOnlyDirty();
    }


    protected function casts(): array
    {
        return [
            'status' => TaskStatus::class,
            'priority' => TaskPriority::class,
        ];
    }
}
