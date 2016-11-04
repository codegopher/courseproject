<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Task;
use Mail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */


    public function rmq_boot() // Establishing connection with RabbitMQ
    {
    	// Params for RabbitMQ connection
	    $connection_params = array(
	  		'host' => 'localhost',
	  		'port' => 5672,
	  		'vhost' => '/',
	  		'login' => 'guest',
	  		'password' => 'guest'
		);
	    $connection = new AMQPConnection($connection_params);
		$connection->connect();
		$channel = new AMQPChannel($connection);
		$exchange = new AMQPExchange($channel);
		$exchange->setName('test_exchange');
		$exchange->setType(AMQP_EX_TYPE_DIRECT);
		$exchange->setFlags(AMQP_DURABLE);
		$exchange->declare();
		$queue = new AMQPQueue($channel);
		$queue->setName('first queue');
		$queue->setFlags(AMQP_IFUNUSED | AMQP_AUTODELETE);
		$queue->declare();
		$result = $exchange->publish(json_encode("Hello world!"), "foo_key");
		$connection->disconnect();
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
