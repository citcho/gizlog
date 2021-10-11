<?php

namespace App\Console;

use App\Console\Commands\UpdateCategoryRanking;
use App\Console\Commands\UpdateCommentRanking;
use App\Console\Commands\UpdateUserRanking;
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
        UpdateUserRanking::class,
        UpdateCommentRanking::class,
        UpdateCategoryRanking::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('user_ranking:update')->everyThirtyMinutes();
        $schedule->command('comment_ranking:update')->everyThirtyMinutes();
        $schedule->command('category_ranking:update')->everyThirtyMinutes();
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
