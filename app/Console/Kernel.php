<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('chapter:check-delete')->dailyAt('00:00')->withoutOverlapping();
        $schedule->command('crawl:manhwa-chapters')->withoutOverlapping()->everyFiveMinutes();
        $schedule->command('fetch:chapter-images')->withoutOverlapping()->everyFiveMinutes();
        $schedule->command('manwha:index-new-chapters')->withoutOverlapping()->everyFiveMinutes();



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
