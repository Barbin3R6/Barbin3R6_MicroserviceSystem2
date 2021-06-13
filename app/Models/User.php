<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class User extends Model{

    protected $table = 'userinfo';
    // column sa table
    protected $fillable = [
    'fname','lname','username','password','status','jobid'
    ];

    public $timestamps = false;
    protected $primaryKey = 'userid';

}
