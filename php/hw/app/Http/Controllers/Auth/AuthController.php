<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Subject;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    
    protected function create(array $data)
    {
        $nuser = User::create([
            'name' => $data['name'], // standart login field
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'firstname' => $data['firstname'],
            'surname' => $data['surname'],
        ]);
      //many-to-many connection with model
        // foreach can be replaced with attach($array), but it works too
      foreach ($data['subj'] as $i) {
        //error_log($i);
        $nuser->subjects()->attach($i);
      }
      return $nuser;
    }

    // redefined, original in registersusers trait
    public function showRegistrationForm()
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }
        $subjectarray=Subject::All();
        return view('auth.register',['htmldata'=>$subjectarray]);
    }
}
