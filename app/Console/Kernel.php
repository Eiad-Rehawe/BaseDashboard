<?php

namespace App\Console;

use App\Console\Commands\EmailsDelete;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('emails:delete')
        ->weekly();
    

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
