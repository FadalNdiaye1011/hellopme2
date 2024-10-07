<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AbonnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  User::first();
        $data = [
            ['type' => 'Premium', 'durations' => 1, 'statut' => 1, 'price' => 4900, 'user_id' => $user->id],
            ['type' => 'Premium', 'durations' => 3, 'statut' => 1, 'price' => 9900, 'user_id' => $user->id],
            ['type' => 'Premium', 'durations' => 12, 'statut' => 1, 'price' => 49900, 'user_id' => $user->id],
            ['type' => 'Gold', 'durations' => 12, 'statut' => 1, 'price' => 45000, 'user_id' => $user->id],
        ];

        DB::table('abonnements')->insert($data);
    }
}
