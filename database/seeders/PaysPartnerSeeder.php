<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PaysPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // ['pays_id' => 186], 
            // ['pays_id' => 39],
            ['pays_id' => 37],

        ];
        DB::table('pays_partners')->insert($data);
    }
}
