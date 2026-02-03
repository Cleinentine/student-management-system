<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    public $timestamps = false;

    protected $fillable = ['id', 'logo', 'name'];

    public function dean()
    {
        return $this->hasOne(Dean::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
