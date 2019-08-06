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
        Commands\UpdatePdfCount::class,
		Commands\SendReminderEmails::class,
		Commands\SendDigestEmail::class
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

         $schedule->command('daily:update')
                  ->daily()
                  ->timezone('Europe/Berlin');
				  
		$schedule->command('email:reminder')
			  ->dailyAt('09:00')
			  ->timezone('Europe/Berlin');	 

		$schedule->command('email:digest')
			  ->weeklyOn(1,'08:00') //mondays at 08:00
			  ->timezone('Europe/Berlin');	  			  
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
