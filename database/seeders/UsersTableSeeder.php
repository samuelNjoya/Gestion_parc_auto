<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;     
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.  php artisan db:seed
     */
   public function run()
    {
        DB::table('users')->insert([
            [
                'nom' => 'Admin',
                'prenom' => 'Super',
                'email' => 'admin@example.com',
                'password' => Hash::make('123456'),
                'role' => 1,
                'statut' => 1,
                'is_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Gestionnaire',
                'prenom' => 'Jean',
                'email' => 'gestionnaire@example.com',
                'password' => Hash::make('123456'),
                'role' => 2,
                'statut' => 1,
                'is_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Comptable',
                'prenom' => 'Marie',
                'email' => 'comptable@example.com',
                'password' => Hash::make('123456'),
                'role' => 3,
                'statut' => 1,
                'is_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Conducteur',
                'prenom' => 'Paul',
                'email' => 'conducteur@example.com',
                'password' => Hash::make('123456'),
                'role' => 4,
                'statut' => 1,
                'is_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
