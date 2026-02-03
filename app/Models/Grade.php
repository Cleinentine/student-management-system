<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'assessment_id',
        'student_id',
        'score',
        'remarks'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
