<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ExpertiseDomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['libelle' => 'Stratégie et innovation'], ['libelle' => 'Leadership et management'],
            ['libelle' => 'Marketing / Ventes'],['libelle' => 'Fiscalité'], 
            ['libelle' => 'Organisation et finances'], ['libelle' => 'Elaboration de Business Plan']
        ];
        DB::table('expertise_domains')->insert($data);
    }
}
