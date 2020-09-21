<?php

namespace Database\Seeders;

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
        //chamando o seeder de usuários
        $this->call([
            UserSeeder::class,
            WalletSeeder::class
        ]);
    }
}
