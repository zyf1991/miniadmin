<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    //
    protected $table = 'sign';
    protected $fillable=[
        'c_id',
        'plan_id',
        'is_sign',
        'sign_text',
        'sign_time',
        'sign_image'
    ];
}
