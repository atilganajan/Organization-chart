<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name','parent_department_id'];

    public function parentDepartment()
    {
        return $this->belongsTo(Department::class, 'parent_department_id');
    }

    public function subDepartments()
    {
        return $this->hasMany(Department::class, 'parent_department_id');
    }

    public function persons()
    {
        return $this->hasMany(Person::class);
    }


}
