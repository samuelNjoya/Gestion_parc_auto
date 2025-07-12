<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculeSeeder extends Seeder
{
    /**
     * Run the database seeds.  php artisan db:seed --class=VehiculeSeeder
     */

    public function run()
    {
        DB::table('vehicule')->insert([
            [
                'id' => 1,
                'created_by_id' => 1,
                'immatriculation' => 'LT-456-CA',
                'marque' => 'Renault',
                'modele' => 'CLIO',
                'photo' => '20250524091645jqfjtfteygwjp59gs4ke.jpeg',
                'kilometrage' => 95000,
                'type_carburant' => 'essence',
                'date_achat' => '2019-04-12',
                'statut' => 1,
                'departement' => 'technique',
                'is_delete' => 0,
                'updated_at' => '2025-05-29 21:35:05',
                'created_at' => '2025-05-15 15:53:58',
            ],
            [
                'id' => 2,
                'created_by_id' => 1,
                'immatriculation' => 'LT-145-AB',
                'marque' => 'Toyota',
                'modele' => 'fg',
                'photo' => '202505160703112upusjafqrretvcomcyv.jpeg',
                'kilometrage' => 130,
                'type_carburant' => 'essence',
                'date_achat' => '2019-04-12',
                'statut' => 1,
                'departement' => 'financier',
                'is_delete' => 0,
                'updated_at' => '2025-05-29 21:35:23',
                'created_at' => '2025-05-15 15:54:39',
            ],
            [
                'id' => 3,
                'created_by_id' => 1,
                'immatriculation' => 'LT-456-CD',
                'marque' => 'Peugeot',
                'modele' => '208',
                'photo' => '20250519115832syfu3ax1ke8z3m8qklhv.pdf',
                'kilometrage' => 170,
                'type_carburant' => 'electrique',
                'date_achat' => '2023-03-15',
                'statut' => 1,
                'departement' => 'technique',
                'is_delete' => 0,
                'updated_at' => '2025-05-29 21:35:32',
                'created_at' => '2025-05-15 16:39:42',
            ],
            [
                'id' => 4,
                'created_by_id' => 1,
                'immatriculation' => 'LT-123-AB',
                'marque' => 'Toyota',
                'modele' => 'Corolla',
                'photo' => '20250524090948xtflkchceyepckbifmkt.jpeg',
                'kilometrage' => 85000,
                'type_carburant' => 'diesel',
                'date_achat' => '2025-05-12',
                'statut' => 1,
                'departement' => 'technique',
                'is_delete' => 0,
                'updated_at' => '2025-05-29 21:35:42',
                'created_at' => '2025-05-24 21:09:48',
            ],
            [
                'id' => 5,
                'created_by_id' => 1,
                'immatriculation' => 'LT-321-GH',
                'marque' => 'Volkswagen',
                'modele' => 'GOLF',
                'photo' => '202505240914261sn3b0tpeyxdudwu9naj.jpeg',
                'kilometrage' => 25000,
                'type_carburant' => 'hybride',
                'date_achat' => '2023-05-12',
                'statut' => 1,
                'departement' => 'financier',
                'is_delete' => 0,
                'updated_at' => '2025-05-29 21:35:51',
                'created_at' => '2025-05-24 21:14:26',
            ],
            [
                'id' => 6,
                'created_by_id' => 1,
                'immatriculation' => 'LT-145-FG',
                'marque' => 'Toyota',
                'modele' => 'Corola',
                'photo' => '20250530032812zhxsnjuwnhknandicrdx.jpg',
                'kilometrage' => 15000,
                'type_carburant' => 'electrique',
                'date_achat' => '2023-05-12',
                'statut' => 1,
                'departement' => 'financier',
                'is_delete' => 0,
                'updated_at' => '2025-07-09 20:51:09',
                'created_at' => '2025-05-30 03:28:12',
            ],
        ]);
    }
}
