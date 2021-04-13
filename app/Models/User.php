<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class User extends Model{

    protected $table = 'userinfo';
    // column sa table
    protected $fillable = [
    'userid','fname','lname','username','password','status'
    ];

}
