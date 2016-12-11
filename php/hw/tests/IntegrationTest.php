<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IntegrationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIntegration()
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
        SeePageIs('/home')->
        press('exit')-> // logout
        visit('/auth')->
        type('testlogin', 'login')->
        type('abcd', 'password')->
        press('Authenticate')->
        seePageIs('/home')->
        visit('/create')->
        type('testname', 'name')->
        type('testsurname', 'surname')->
        type('test@example.com', 'email')->
        type('89161234567', 'pnum')->
        type('test task', 'tasktext')->
        press('Send')->
        seeInDatabase('tasks',['tasktext'=>'test task'])-> // unique field
        visit('/home')->
        click('avaliable')->
        with('task'.App\Task::find('tasktext'=>'test task')->first())->
        press('Take')->
        seeInDatabase('usertasks',[App\User::find('name'=>'testlogin')->first() => App\Task::find('tasktext'=>'test task')->first())->
        with('task'.App\Task::find('tasktext'=>'test task')->first())-> // redirect here
        type('solve text','comment')->
        press('Close')->
        seeInDatabase('tasks',['id' => App\Task::find('tasktext'=>'test task')->first(), 'solver' => App\User::find('name'=>'testlogin')->first()]);
    }

    public function testHiLoad()
    {
    	$user = factory(App\User::class)->create(['subject'=>1]);
        factory(App\Task::class, 5000)->create(['hasbeensent' => '0','solver'=>$user->id, 'subject'=>1]);
        // what comes next is 5000 to poor guy who was generated at start of this test because messaging is bootstrapped to "create" event
    }
}
