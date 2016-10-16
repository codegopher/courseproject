<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
