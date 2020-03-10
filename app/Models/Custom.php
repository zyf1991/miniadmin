<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    //
    protected $fillable=[
        'id',
        'name',
        'wxname',
        'sex',
        'age',
        'cardId',
        'birth',
        'tag',
    ];
}
