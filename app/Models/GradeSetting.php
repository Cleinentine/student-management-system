<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeSetting extends Model
{
    protected $fillable = [
        'faculty_id',
        'attendance_weight',
        'homework_weight',
        'quiz_weight',
        'midterm_weight',
        'finals_weight',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
