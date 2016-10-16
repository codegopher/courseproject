<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\Subject;
use Auth;
//use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr = auth::user()->tasks()->whereNull('solver_id')->get(); // taken by current user
        //$arr = auth::user()->tasks(); // taken by current user
        return view('home.index',['htmldata'=>$arr]);
    }

    public function avaliable()
    {
        $arr = auth::user()->avaliable_tasks(); // avaliable to current user, implemented in User model
        return view('home.avaliable',['htmldata'=>$arr]);
    }
}
