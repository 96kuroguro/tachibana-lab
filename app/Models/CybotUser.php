<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CybotUser extends Model
{
    //
    protected $fillable = [
        'from_id',
        'is_bot',
        'first_name',
        'language_code',
        'name',
        'scene',
        'turn',
        'san',
    ];
}
