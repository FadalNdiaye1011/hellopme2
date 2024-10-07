<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PaysSeeder::class,
            ExpertiseDomainSeeder::class,
            SecteurActiviteSeeder::class,
            RolesAndPermissionsSeeder::class,
            PaysPartnerSeeder::class,
            TypeOpportunitySeeder::class,
            SecteurChildrenSeed::class,
            PrescripteurSeeder::class,
            DatabankSeeder::class
            // AbonnementSeeder::class
        ]);
    }
}
