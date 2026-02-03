<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'program_id',
        'section_id',
        'user_id',
        'student_number',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'home_address',
        'avatar',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function program()
    {
        return $this->hasOne(Program::class);
    }

    public function section()
    {
        return $this->hasOne(Section::class);
    }

    public function thesis()
    {
        return $this->hasOne(Thesis::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
