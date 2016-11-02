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
    public function boot()
    {
    // $task is a task after some action
	  Task::updated(function($task){
	  	error_log("ServiceProvider: updated");
	  	error_log($task->isactive);
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
