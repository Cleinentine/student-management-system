<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'faculty_id',
        'section_id',
        'start_time',
        'end_time',
        'start_day',
        'end_day',
    ];

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
