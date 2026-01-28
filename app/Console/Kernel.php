<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('app:send-booking-reminders')->hourly();
        // $schedule->command('app:send-booking-reminders')->everyMinute();
        // $schedule->command('app:send-booking-reminders')->everyFourHours();
        $schedule->command('app:send-booking-reminders')->everyThreeHours();
        // $schedule->command('app:send-booking-reminders')->dailyAt('08:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
