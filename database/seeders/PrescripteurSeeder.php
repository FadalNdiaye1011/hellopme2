<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PrescripteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['libelle' => 'Hello PME', 'titre_responsable' => 'CEO', 'nom_responsable' => 'Roland Kyedrebeogo', 'phone_responsable' => '+22670284848'], 
        ];
        DB::table('prescripteurs')->insert($data);
    } 
}
