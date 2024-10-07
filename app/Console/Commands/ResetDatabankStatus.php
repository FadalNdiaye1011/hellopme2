<?php

namespace App\Console\Commands;

use App\Models\Databank;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ResetDatabankStatus extends Command
{
    protected $signature = 'databanks:reset-status';
    protected $description = 'Reset the status of databanks that are being modified for too long';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Récupérer les opportunités qui sont en "being_modified" depuis plus de 1 heure, par exemple
        $timeout = Carbon::now()->subHours(1);

        $databanks = Databank::where('etat', 'being_modified')
                            ->where('locked_at', '<', $timeout)
                            ->get();

        foreach ($databanks as $databank) {
            $databank->etat = $databank->previous_etat ?: 'unmodified';
            $databank->previous_etat = null;
            $databank->locked_by = null;
            $databank->locked_at = null;
            $databank->save();
        }

        $this->info("Found {$databanks->count()} databanks to reset.");
    }
}
