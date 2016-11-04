<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Task extends Model
{
	protected $fillable = [
      'contactemail', 'contactnumber', 'tasktext', 'taskfile', 'isactive', 'solutiontext', 'solutionfile', 'firstname', 'surname', 'telegram_response', 'subject_id' , 'solver_id'
    ];
    public $timestamps = true;
    protected $table = 'tasks';

    public function solver()
    {
        return $this->hasOne('App\User', 'id', 'solver_id');
    }


    public static function overdue_tasks()
    {
    	error_log("In overdue tasks function");
    	$ot = Task::whereRaw("TO_DAYS(NOW()) - TO_DAYS(tasks.created_at) >= 21 AND tasks.hasbeensent = 0")->get();
    	// using raw "where" condition to overcome date formatting troubles
    	error_log(count($ot).' ovedue tasks');
    	return $ot;
    	// var_dump($ot[0]->created_at);
    }

}
