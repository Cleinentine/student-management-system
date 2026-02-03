<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'faculty_id',
        'student_id',
        'time_in',
        'time_in_location',
        'time_out',
        'time_out_location',
        'remarks',
        'type',
    ];

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
