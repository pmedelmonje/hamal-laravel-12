<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'is_answered',
    ];

    protected function casts(): array
    {
        return [
            'is_answered' => 'boolean',
        ];
    }
}
