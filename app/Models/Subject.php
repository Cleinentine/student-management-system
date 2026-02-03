<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'college_id',
        'code',
        'title',
        'unit'
    ];

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function handledSubjects()
    {
        return $this->hasMany(HandledSubject::class);
    }
}
