<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NegativeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTaskData()
    {
        $this->visit('/create')->
        type('testname', 'name')->
        type('testsurname', 'surname')->
        type('test@example.com', 'email')->
        type('8916123456', 'pnum')-> // lack of digits
        type('test task', 'tasktext')->
        press('Send')->
        dontSeeInDatabase('tasks',['tasktext'=>'test task']);

        $this->visit('/create')->
        type('testname', 'name')->
        type('testsurname', 'surname')->
        type('testexample.com', 'email')-> // wrong email
        type('89161234567', 'pnum')->
        type('test task', 'tasktext')->
        press('Send')->
        dontSeeInDatabase('tasks',['tasktext'=>'test task']);

        $this->visit('/create')->
        type('testname', 'name')->
        type('testsurname', 'surname')->
        type('test@example.com', 'email')->
        type('89161234567', 'pnum')->
        type('', 'tasktext')-> // empty task text
        press('Send')->
        dontSeeInDatabase('tasks',['tasktext'=>'test task']);
    }

    public function testSolveData()
    {
    	$user = factory(App\User::class)->create();
    	$task = factory(App\Task::class)->create();
        $this->actingAs($user)->
        visit('/home')->
        with('task'.$task->id)->
        type('','comment')-> // empty solve text
        press('Close')->
        dontSeeInDatabase('tasks',['id' => $task->id, 'solver' => $user->id]);
    }

    public function testRegisterData()
    {
    	$user = factory(App\User::class)->create();

        $this->visit('/register')->
        type('testname', 'firstname')->
        type('testsurname', 'surname')->
        type('test@example.com', 'email')->
        type('8916123456', 'pnum')-> // wrong number: lack of digits
        type('testlogin', 'name')-> // Laravel login field
        check('Математика')-> // subject
        type('abcd'->'password')->
        type('abcd'->'confirm')->
        press('Register')->
        dontSeeInDatabase('users',['name'=>'testlogin']); // unique field

        $this->visit('/register')->
        type('testname', 'firstname')->
        type('testsurname', 'surname')->
        type('testexample.com', 'email')-> // wrong email
        type('89161234567', 'pnum')->
        type('testlogin', 'name')-> // Laravel login field
        check('Математика')-> // subject
        type('abcd'->'password')->
        type('abcd'->'confirm')->
        press('Register')->
        dontSeeInDatabase('users',['name'=>'testlogin']); // unique field

        $this->visit('/register')->
        type('testname', 'firstname')->
        type('testsurname', 'surname')->
        type('test@example.com', 'email')->
        type('89161234567', 'pnum')->
        type('testlogin', 'name')-> // Laravel login field
        check('Математика')-> // subject
        type('abcd'->'password')->
        type('abcde'->'confirm')-> // inconsistent passwords
        press('Register')->
        dontSeeInDatabase('users',['name'=>'testlogin']); // unique field

        $this->visit('/register')->
        type('testname', 'firstname')->
        type('testsurname', 'surname')->
        type('test@example.com', 'email')->
        type('89161234567', 'pnum')->
        type('testlogin', $user->name)-> // existing login
        check('Математика')-> // subject
        type('abcd'->'password')->
        type('abcd'->'confirm')->
        press('Register')->
        dontSeeInDatabase('users',['name'=>'testlogin']); // unique field

        $this->visit('/register')->
        type('testname', 'firstname')->
        type('testsurname', 'surname')->
        type('test@example.com', 'email')->
        type('89161234567', 'pnum')->
        type('testlogin', 'name')-> // existing login, empty subjects list
        type('abcd'->'password')->
        type('abcd'->'confirm')-> // inconsistent passwords
        press('Register')->
        dontSeeInDatabase('users',['name'=>'testlogin']); // unique field
    }

    public function testAuthData()
    {
    	$user = factory(App\User::class)->create();
        $this->visit('/auth')->
        type('login', $user->name.'abc')-> // non-existing login
        type('password', $user->password)->
        press('Authenticate')->
        dontSeePageIs('/home'); // unique field

        $user = factory(App\User::class)->create();
        $this->visit('/auth')->
        type('login', $user->name)->
        type('password', $user->password."abc")-> // wrong password
        press('Authenticate')->
        dontSeePageIs('/home'); // unique field
    }
}
