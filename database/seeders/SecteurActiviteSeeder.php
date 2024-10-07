<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SecteurActiviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['libelle' => 'Digital'], ['libelle' => 'Formation'],
            ['libelle' => 'Bâtiment et travaux publics'],['libelle' => 'Pétrole, mines et gaz'], 
            ['libelle' => 'Industrie agro-alimentaire'], ['libelle' => 'Consulting']
        ];
        DB::table('secteur_activites')->insert($data);
    }
}
