<?php

namespace App\Console;

use App\Http\Controllers\GMController;
use App\Models\GM;
use App\Models\Region;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $gmList = new GMController();
            $gmList->verifyToken();
            
            GM::truncate();
            $region_list = Region::all();
            foreach($region_list as $region) {
                $gmList->store($region->id);
            }
        })->everyTenMinutes();
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
