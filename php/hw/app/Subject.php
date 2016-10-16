<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamps = false;
    protected $table = 'subjects';

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function users()
    {
    	return $this->belongsToMany('App\User', 'usersubjects', 'subject_id', 'user_id');
    }
}
