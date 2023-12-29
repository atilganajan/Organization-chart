<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname',"photo","position","department_id"];

    protected $table = 'persons';


    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
