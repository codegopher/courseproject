<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FunctionalTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->visit('/create')->
        type('testname', 'name')->
        type('testsurname', 'surname')->
        type('test@example.com', 'email')->
        type('89161234567', 'pnum')->
        type('test task', 'tasktext')->
        press('Send')->
        seeInDatabase('tasks',['tasktext'=>'test task']);
    }

    public function testToWork()
    {
    	$user = factory(App\User::class)->create();
    	$task = factory(App\Task::class)->create();
        $this->actingAs($user)->
        visit('/home')->
        click('avaliable')->
        with('task'.$task->id)->
        press('Take')->
        seeInDatabase('usertasks',[$user->id => $task->id]);
    }

    public function testClose()
    {
    	$user = factory(App\User::class)->create();
    	$task = factory(App\Task::class)->create();
        $this->actingAs($user)->
        visit('/home')->
        with('task'.$task->id)->
        type('solve text','comment')->
        press('Close')->
        seeInDatabase('tasks',['id' => $task->id, 'solver' => $user->id]);
    }

    public function testRegister()
    {
        $this->visit('/register')->
        type('testname', 'firstname')->
        type('testsurname', 'surname')->
        type('test@example.com', 'email')->
        type('89161234567', 'pnum')->
        type('testlogin', 'name')-> // Laravel login field
        check('Математика')-> // subject
        type('abcd'->'password')->
        type('abcd'->'confirm')->
        press('Register')->
        seeInDatabase('users',['name'=>'testlogin']); // unique field
    }

    public function testAuth()
    {
    	$user = factory(App\User::class)->create();
        $this->visit('/auth')->
        type('login', $user->name)->
        type('password', $user->password)->
        press('Authenticate')->
        seePageIs('/home'); // unique field
    }
}
