<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $table = 'course';
    protected $fillable=[
        "class_id",
        "name",
        "c_video",
        "video_cover",
        "video_desc",
        "trysee",
        "shelf",
        "shelftime",
        "saletype",
        "salesetting",
        "saleprice",
        "delprice",
        "showpostion"
    ];
}
