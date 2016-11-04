<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
      ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {        
        $schedule->call(function(){
            error_log("Sending overdue tasks...");
            // Send tasks and mark them as sent in DB
            /*
            $ot = Task::overdue_tasks();
            foreach ($ot as $t) {
                // Send somehow
                $t->hasbeensent = 1;
                $t->save();
            }
            */
        })->dailyAt('12:00');;
    }
}
