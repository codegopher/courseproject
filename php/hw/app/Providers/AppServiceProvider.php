<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Task;
use Mail;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

use App\Jobs\SendTelegramNotification;
use Queue;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {

    // $task is a task after some action
	  Task::updated(function($task){
	  	error_log("ServiceProvider: task has been updated");
	  	if($task->solver_id) {
		  	$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
			$channel = $connection->channel();
			$channel->queue_declare('email-out', true, false, false, false);
			$channel->exchange_declare('X', 'topic', false, false, false);
			$channel->queue_bind('email-out', 'X', '#');
		  	$msg = new AMQPMessage($task->toJSON());
		  	$channel->basic_publish($msg, 'X', 'recipient@example.com');

		  	Queue::push(new SendTelegramNotification($task,"upd"));
	  	}


	  });

	  Task::created(function($task){
	  	error_log("ServiceProvider: task has been created");
		  	$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
			$channel = $connection->channel();
			$channel->queue_declare('email-out', true, false, false, false);
			$channel->exchange_declare('X', 'topic', false, false, false);
			$channel->queue_bind('email-out', 'X', '#');
		  	$msg = new AMQPMessage($task->toJSON());
		  	$channel->basic_publish($msg, 'X', 'recipient@example.com');

		  	Queue::push(new SendTelegramNotification($task,"crt"));
	  });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    	error_log(date("Y-m-d H:i:s") . ": launching app");
    }
}
