<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallets')->insert([
            'user_id' => '1',
            'balance' => '50.00'
        ]);

        DB::table('wallets')->insert([
            'user_id' => '2',
            'balance' => '50.00'
        ]);

        DB::table('wallets')->insert([
            'user_id' => '3',
            'balance' => '50.00'
        ]);

        DB::table('wallets')->insert([
            'user_id' => '4',
            'balance' => '50.00'
        ]);
    }
}
