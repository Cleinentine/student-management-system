<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    protected $fillable = [
        'student_id',
        'title',
        'summary',
        'thesis',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
