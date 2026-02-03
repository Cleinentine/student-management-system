<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'faculty_id',
        'subject_id',
        'title',
        'description',
        'material',
        'deadline',
        'status',
        'type',
    ];

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
