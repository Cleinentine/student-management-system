<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HandledSubject extends Model
{
    protected $fillable = [
        'faculty_id',
        'subject_id'
    ];

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
