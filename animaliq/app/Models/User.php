<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'profile_photo',
        'bio',
        'status',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
    }

    public function departmentMembers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DepartmentMember::class, 'user_id');
    }

    public function membership(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Membership::class, 'user_id');
    }

    public function eventRegistrations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EventRegistration::class, 'user_id');
    }

    public function volunteerHours(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VolunteerHour::class, 'user_id');
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function donations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Donation::class, 'user_id');
    }

    public function hasRole(string|array $roles): bool
    {
        $names = is_array($roles) ? $roles : [$roles];
        if (in_array($this->role, $names, true)) {
            return true;
        }
        return $this->roles()->whereIn('name', $names)->exists();
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'super_admin';
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Admin sections this user is allowed to access in the admin panel.
     * Super_admin: all sections. Admin: union of admin_sections from their departments.
     */
    public function allowedAdminSections(): array
    {
        if ($this->isSuperAdmin()) {
            return array_merge(
                array_keys(config('admin_sections.assignable_sections', [])),
                config('admin_sections.super_admin_only_sections', [])
            );
        }
        if ($this->role !== 'admin') {
            return [];
        }
        $departments = $this->departmentMembers()->with('department')->get()->pluck('department')->filter();
        $sections = $departments->pluck('admin_sections')->filter()->flatten()->unique()->values()->all();
        $sections = array_values(array_unique($sections));
        if (! empty($sections)) {
            $sections[] = 'dashboard';
        }
        return array_values(array_unique($sections));
    }

    /** Check if the current user can access the given admin section key. */
    public function canAccessAdminSection(string $section): bool
    {
        return in_array($section, $this->allowedAdminSections(), true);
    }
}
