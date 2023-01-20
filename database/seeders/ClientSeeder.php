<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::firstOrCreate([
            'name' => "Honore IMANISHIMWE",
            'phone_number' => 780850976,
            'card_uid' => "421713225166",
            'balance' => 30000,
            'password' => Hash::make('password')
        ]);
    }
}
