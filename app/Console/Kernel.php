<?php

namespace App\Console;

use App\Http\Services\MedicationPackageService;
use App\Http\Services\PointsService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        //todo worker for validate  discount code

        $schedule->call(function () {
            $pointsService = new PointsService();
            $pointsService->pointsExpiration();
            $pointsService->pointsCalculation();
        })->daily();

        $schedule->call(function () {
            $medicationPackageService = new MedicationPackageService();
            $medicationPackageService->sendNotification();
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
