<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth;
class User extends Model
{
    //
    protected $table = 'users';
    protected $fillable=[
        'name',
        'email',
        'password',
        'api_token'
    ];
    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }
}
