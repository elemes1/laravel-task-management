<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements   FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function roles() {
        return $this->belongsToMany(Role::class, 'user_roles');
    }


    public function tasks() {
        return $this->hasManyThrough(Task::class, Plan::class, 'created_by', 'plan_id', 'id');
    }

    public function plans() {
        return $this->hasMany(Plan::class, 'created_by');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'user_id');
    }


    public function activities() {
        return $this->hasMany(Activity::class, 'performed_by');
    }

    public function attachments() {
        return $this->hasMany(Attachment::class, 'uploaded_by');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return   in_array(config('todo.default_admin_role_name'), $this->roles()->pluck('name')->toArray() ) ; // && $this->hasVerifiedEmail();
    }
}
