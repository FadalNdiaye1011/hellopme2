<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SecteurChildrenSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['libelle' => 'Fourniture de matériel informatique', 'secteur_activite_id' => 1], 
            ['libelle' => 'Réseaux et télécommunications', 'secteur_activite_id' => 1],
            ['libelle' => 'Développement web', 'secteur_activite_id' => 1]
        ];
        DB::table('secteur_activite_children')->insert($data);
    }
}
