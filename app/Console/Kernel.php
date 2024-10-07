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
        // Définir le fuseau horaire global pour les tâches planifiées
        $schedule->timezone('Africa/Dakar');

        // Exécuter la commande 'ScrapeOpportunity' tous les jours
        $schedule->command('ScrapeOpportunity')
            ->daily();

        // Exécuter la commande 'ScrapeOpportunityData' chaque minute
        $schedule->command('ScrapeOpportunityData')
            ->everyMinute();

        // Exécuter la commande 'ScrapeOpportunityData' chaque minute
        $schedule->command('ScrapNation_Unis')
            ->everyMinute();

        // Exécuter la commande 'ScrapeOpportunityData' chaque minute
        $schedule->command('ScrapNation_Bceao')
            ->everyMinute();

        $schedule->command('databanks:reset-status')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Charger les commandes artisan du répertoire "Commands"
        $this->load(__DIR__ . '/Commands');

        // Charger les routes de console définies dans "routes/console.php"
        require base_path('routes/console.php');
    }
}
