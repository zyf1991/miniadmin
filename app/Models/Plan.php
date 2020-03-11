<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table = 'plan';
    protected $fillable=[
        'c_id',
        'plan_title',
        'plan_desc',
        'plan_stime',
        'plan_etime',
        'plan_stime',
        'sys_etime',
        'plan_type'
    ];
}
