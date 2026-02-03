<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'dean_id',
        'user_id',
        'name',
        'avatar'
    ];

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function dean()
    {
        return $this->belongsTo(Dean::class);
    }

    public function gradeSettings()
    {
        return $this->hasOne(GradeSetting::class);
    }

    public function handledSubjects()
    {
        return $this->hasMany(HandledSubject::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
