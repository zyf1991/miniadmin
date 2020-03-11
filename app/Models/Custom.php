<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    //
    protected $table = 'custom';
    protected $fillable=[
        'name',
        'wxname',
        'sex',
        'age',
        'cardId',
        'birth',
        'tag',
    ];
}
