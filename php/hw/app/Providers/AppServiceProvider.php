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


    	/*
		$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
		$this->channel = $connection->channel();
		$this->channel->queue_declare('email', false, false, false, false);
		$this->channel->queue_declare('tlg', false, false, false, false);
		*/
		//$array1 = ['key1'=>'val1', 'key2'=>'val2', 'date'=>date("Y-m-d H:i:s")];
		//$array2 = ['key3'=>'val3', 'key4'=>'val4', 'date'=>date("Y-m-d H:i:s")];
		//$msg1 = new AMQPMessage(json_encode($array1));
		//$msg2 = new AMQPMessage(json_encode($array2));
		// $msg = new AMQPMessage('Hello World!');
		//$channel->basic_publish($msg1, '', 'email');
		//$channel->basic_publish($msg2, '', 'tlg');

		//$channel->close();
		//$connection->close();
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


	  	$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
		$channel = $connection->channel();
		$channel->queue_declare('email-out', true, false, false, false);
		$channel->exchange_declare('X', 'topic', false, false, false);
		$channel->queue_bind('email-out', 'X', '#');
	  	$msg = new AMQPMessage($task->toJSON());
	  	$channel->basic_publish($msg, 'X', 'recipient@example.com');


	  });

	  Task::created(function($task){
	  	error_log("ServiceProvider: task has been created");
	  	// Send to user somehow
	  });
	  // mail("test@test.com", "Test subject", "Test line on current date" . date("Y-m-d H:i:s")); 
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
    	error_log(date("Y-m-d H:i:s") . ": launching app");
        //$this->rmq_boot();
    }
}
