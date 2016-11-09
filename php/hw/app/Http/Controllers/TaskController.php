<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Task;

use App\User;
use Auth;

class TaskController extends Controller
{
    public function index()
    {
      error_log("REST index");
      return redirect('/main');
    }

    public function create()
    {
      error_log("REST create");
      return redirect('/main');
    }

    public function store(Request $request)
    // make a task
    {
       error_log("REST store");
       $data = $request->all(); // instead of Input::file('taskfile'); or Input-get...

       $tr = true;
       if (empty($data['telegram_response'])) {$tr = false;} // костыль
// !
       error_log("Telegram response:");
       error_log($tr); // не работает. Хоть убей, не знаю, почему!
// !
       //$file = Input::file('taskfile');
       //error_log($_FILES['taskfile']['name']); // useful

       $task = Task::create([
            'contactemail' => $data['email'],
            'contactnumber' => $data['pnum'],
            'tasktext' => $data['comment'],
            //'taskfile' => 'no file',
            'isactive' => true,
            'solutiontext' => "Not solved yet",
            'solutionfile' => "/dev/null",
       		'firstname' => $data['firstname'],
       		'surname' => $data['surname'],
       		'telegram_response' => $tr,
       		'subject_id' => $data['subject']
        ]);
      if (isset($data['taskfile'])) {
	    $id = $task['id']; // created task id
      $file = $data['taskfile']; // uploaded file
      $name = $file->getClientOriginalName(); // its name
      $dest = 'taskfiles/' . $task['id']; // its path
      $task['taskfile'] = $dest . '/' . $name; // its path in DB
      $file->move($dest, $name); // moving file in 'public' directory
      $task->save(); // have to save due to manipulations with task id in file path 
      }
      return redirect('/success');
    }

    public function show($id)
    {
      error_log("REST show");
      return redirect('/main');
    }

    public function edit($id)
    {
      error_log("REST edit");
      return redirect('/main');
    }

    public function update(Request $request, $id)
    // update a task: take, refuse or close
    {
      error_log("REST update");
      $data = $request->all();

      switch ($data['action']) {

          case "take":
              error_log("take");
              auth::User()->tasks()->attach($id);

              $task = Task::find($id);
              $task['isactive'] = false; // other users are not avaliable to take this task
              $task->save();

              return redirect('/home');
              break;

          case "refuse":
              error_log("refuse");
              auth::User()->tasks()->detach($id);

              $task = Task::find($id);
              $task['isactive'] = true; // task is avaliable to be taken again
              $task->save();

              return redirect('/home');
              break;

          case "close":
              error_log("close");
              $task = Task::find($id);

              $task['isactive'] = false; // solved task in unavaliable
              // $task->solver()->associate(auth::User()); // task is considered as solved if someone is marked as solver
              $task['solver_id']= auth::User()->id; // can't think with models here
              $task['solved_at']=date("Y-m-d H:i:s");  // format?
              $file = $data['solutionfile']; // uploaded file
              $name = $file->getClientOriginalName(); // its name
              $dest = 'taskfiles/' . $task['id'] . '/solution'; // its path
              $task['taskfile'] = $dest . '/' . $name; // its path in DB
              $file->move($dest, $name); // moving file in 'public' directory
              $task->save(); // have to save due to manipulations with task id in file path

              return redirect('/home');
              break;
      }

      //return redirect('/home');
    }

     public function destroy($id)
    {
      error_log("REST destroy");
      return redirect('/main');
    }
}
