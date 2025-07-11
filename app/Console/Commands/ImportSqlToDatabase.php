<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportSqlToDatabase extends Command
{
    protected $signature = 'db:import-sql';
    protected $description = 'Importe un fichier SQL brut dans la base Railway';

    public function handle()
    {
        $path = database_path('scripts/parc_auto.sql');

        if (!file_exists($path)) {
            $this->error("Le fichier SQL n'existe pas : $path");
            return 1;
        }

        $sql = file_get_contents($path);
        DB::unprepared($sql);

        $this->info('Base de données importée avec succès !');
        return 0;
    }
}
