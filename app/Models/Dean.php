<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dean extends Model
{
    protected $fillable = [
        'college_id',
        'user_id',
        'name',
        'avatar'
    ];

    public function college()
    {
        return $this->hasOne(College::class);
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
