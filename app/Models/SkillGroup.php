<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillGroup extends Model
{
    protected $fillable = [
        'name',
        'index'
    ];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
