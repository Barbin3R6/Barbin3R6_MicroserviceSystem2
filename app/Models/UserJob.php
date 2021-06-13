<?php

    //change namespace to App\Models if you put your model inside models
    namespace App\Models;

    //library to create model under lumen
    use Illuminate\Database\Eloquent\Model;

    class UserJob extends Model{

        //name of table
        protected $table = 'tbluserjob';
        //column sa table
        protected $fillable = [
            'jobid', 'jobname',
        ];

        //The code below will not require the field created_at and update_at in lumen
        public $timestamps = false;

        //The code will customized your primary key field name, default in lumen is id
        protected $primaryKey = 'jobid';

    }