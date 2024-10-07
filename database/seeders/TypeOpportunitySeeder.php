<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TypeOpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['libelle' => 'Appels d\'offres'], 
            ['libelle' => 'Financements'],
            ['libelle' => 'Evénements']
        ];
        DB::table('type_opportunities')->insert($data);
    }
}
