<?php

namespace App\Console;

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
        $schedule->call(function(){
            $now=new DateTime();
            DB::table('events')->where('status','=','submit')
            ->where('submit','>',$now)
            ->update(['status'=>'result']);
            DB::table('events')->where('status','=','participate')
            ->where('participate','>',$now)
            ->update(['status'=>'submit']);
        })->everyMinute();
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
