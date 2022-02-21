<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Carbon\Carbon;
use App\Models\Offer;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\UpdateOfferStatus::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('offer:status')->daily();
    }
    
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
