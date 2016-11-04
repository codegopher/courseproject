<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB; // just for make this look like OOP

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'surname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'usersubjects', 'user_id', 'subject_id');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'usertasks', 'user_id', 'task_id');
    }

    public function avaliable_tasks()
    {
        // returns an array of objects (records)
        return DB::table('tasks')
            ->leftJoin('subjects', 'tasks.subject_id', '=', 'subjects.id')
            ->leftJoin('usersubjects', 'subjects.id', '=', 'usersubjects.subject_id')
            ->leftJoin('users', 'usersubjects.user_id', '=', 'users.id')
            ->where('users.id','=',$this->id)
            ->where('tasks.isactive','=',true)
            ->select('subjects.name', 'users.id', 'tasks.*')
            ->get();
    }
}
