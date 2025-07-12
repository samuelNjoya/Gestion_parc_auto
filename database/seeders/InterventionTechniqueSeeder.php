<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterventionTechniqueSeeder extends Seeder
{

    /**
     * Run the database seeds.  php artisan db:seed --class=InterventionTechniqueSeeder

     */

    public function run()
    {
        DB::table('intervention_technique')->insert([
            [
                'id' => 1,
                'vehicule_id' => 1,
                'created_by_id' => 18,
                'type' => 'entretien',
                'titre' => 'Entretien général du véhicule',
                'date' => '2025-04-30',
                'cout' => 12000,
                'description' => '',
                'kilometrage' => 14,
                'fournisseur_id' => 6,
                'prochaine_date' => '2025-07-12',
                'frequence' => 'chaque mois',
                'duree_imobilisation' => null,
                'is_delete' => 0,
                'updated_at' => '2025-05-28 02:36:37',
                'created_at' => '2025-05-21',
            ],
            [
                'id' => 2,
                'vehicule_id' => 2,
                'created_by_id' => null,
                'type' => 'maintenance',
                'titre' => 'Vidange moteur',
                'date' => '2025-05-20',
                'cout' => 15000,
                'description' => '',
                'kilometrage' => 15000,
                'fournisseur_id' => 6,
                'prochaine_date' => null,
                'frequence' => '',
                'duree_imobilisation' => 20,
                'is_delete' => 0,
                'updated_at' => '2025-05-21 09:41:22',
                'created_at' => '2025-05-21',
            ],
            [
                'id' => 3,
                'vehicule_id' => 1,
                'created_by_id' => null,
                'type' => 'maintenance',
                'titre' => 'Contrôle technique',
                'date' => '2025-05-26',
                'cout' => 10000,
                'description' => '',
                'kilometrage' => 75000,
                'fournisseur_id' => 10,
                'prochaine_date' => null,
                'frequence' => '',
                'duree_imobilisation' => 15,
                'is_delete' => 0,
                'updated_at' => '2025-05-26 19:27:26',
                'created_at' => '2025-05-26',
            ],
            [
                'id' => 4,
                'vehicule_id' => 3,
                'created_by_id' => null,
                'type' => 'maintenance',
                'titre' => 'Contrôle et réparation panne technique',
                'date' => '2025-05-28',
                'cout' => 13000,
                'description' => 'Une panne technique',
                'kilometrage' => 96000,
                'fournisseur_id' => 10,
                'prochaine_date' => null,
                'frequence' => '',
                'duree_imobilisation' => 5,
                'is_delete' => 0,
                'updated_at' => '2025-05-28 14:35:41',
                'created_at' => '2025-05-28',
            ],
            [
                'id' => 5,
                'vehicule_id' => 1,
                'created_by_id' => 1,
                'type' => 'entretien',
                'titre' => 'Contrôle vidange',
                'date' => '2025-07-09',
                'cout' => 50000,
                'description' => '',
                'kilometrage' => 100000,
                'fournisseur_id' => 10,
                'prochaine_date' => '2025-07-12',
                'frequence' => '',
                'duree_imobilisation' => null,
                'is_delete' => 0,
                'updated_at' => '2025-07-09 21:54:29',
                'created_at' => '2025-07-09',
            ],
            [
                'id' => 6,
                'vehicule_id' => 4,
                'created_by_id' => 17,
                'type' => 'entretien',
                'titre' => 'Contrôle vidange du véhicule',
                'date' => '2025-07-09',
                'cout' => 15000,
                'description' => '',
                'kilometrage' => 100000,
                'fournisseur_id' => 10,
                'prochaine_date' => '2025-07-12',
                'frequence' => 'tous les mois',
                'duree_imobilisation' => null,
                'is_delete' => 0,
                'updated_at' => '2025-07-09 22:54:58',
                'created_at' => '2025-07-09',
            ],
        ]);
    }
}
