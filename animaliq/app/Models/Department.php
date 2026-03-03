<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'mandate'];

    public function departmentMembers(): HasMany
    {
        return $this->hasMany(DepartmentMember::class);
    }

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }

    public function researchProjects(): HasMany
    {
        return $this->hasMany(ResearchProject::class, 'department_id');
    }
}
