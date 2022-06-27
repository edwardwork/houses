<?php

namespace App\Console;

use App\Jobs\ImportFromGoogleSheetJob;
use App\Jobs\UpdateResidentialComplexPriceJob;
use App\Jobs\UpdateResidentialHousePriceJob;
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
         $schedule->job(ImportFromGoogleSheetJob::class)->hourly();
         $schedule->job(UpdateResidentialHousePriceJob::class)->everyThirtyMinutes();
         $schedule->job(UpdateResidentialComplexPriceJob::class)->everyThirtyMinutes();
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
