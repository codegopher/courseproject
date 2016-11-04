<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Task;
use Mail;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */


    public function rmq_boot() // Establishing connection with RabbitMQ
    {
    	error_log("Initializing RabbitMQ");
		$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
		$channel = $connection->channel();
		$channel->queue_declare('email-msg', false, false, false, false);
		$channel->queue_declare('tlg-msg', false, false, false, false);
		$array1 = ['key1'=>'val1', 'key2'=>'val2'];
		$array2 = ['key3'=>'val3', 'key4'=>'val4'];
		$msg1 = new AMQPMessage(json_encode($array1));
		$msg2 = new AMQPMessage(json_encode($array2));
		// $msg = new AMQPMessage('Hello World!');
		$channel->basic_publish($msg1, '', 'email-msg');
		$channel->basic_publish($msg2, '', 'tlg-msg');
		$channel->close();
		$connection->close();
    }

    public function boot()
    {
    	$this->rmq_boot();
    // $task is a task after some action
	  Task::updated(function($task){
	  	error_log("ServiceProvider: task has been updated");
	  	if($task->solver_id) {
	  		// send solved task to user
	  	}
	  });

	  Task::created(function($task){
	  	error_log("ServiceProvider: task has been created");
	  	// Send to user somehow
	  });
	  // mail("test@test.com", "Test subject", "Test line"); 
	  // Sendmail not found. Have to use custom or sided SMTP

	  // Task::updating(function($task){error_log("ServiceProvider: updating");}); // works too
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
