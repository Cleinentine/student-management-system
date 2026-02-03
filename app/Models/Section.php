<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'college_id',
        'section_number',
        'section_alphabet'
    ];

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
