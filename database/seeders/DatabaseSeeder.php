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
        //Devido ao fato da aplicação não necessitar de um CRUD de usuários
        //estou inserindo no banco 2 usuários do tipo PF (1 testador e 1 random) e 
        //estou inserindo 2 usuários do tipo PJ (1 testador e 1 random)

        //Pessoa física
        DB:table('users')->insert([
            'name' => 'Testador Pessoa Física',
            'email' => 'testadorpf@email.com.br',
            'document' => '12345678912',
            'type' => 'pf',
            'balance' => '50.00',
            'password' => Hash::make('password')
        ]);

        //Pessoa física
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@email.com',
            'document' => '12345678912',
            'type' => 'pf',
            'balance' => '50.00',
            'password' => Hash::make('password'),
        ]);

        //Pessoa Jurídica
        DB::table('users')->insert([
            'name' => 'Testador Pessoa Jurídica',
            'email' => 'testadorpj@email.com.br',
            'document' => '12345678912345',
            'type' => 'pj',
            'balance' => '50.00',
            'password' => Hash::make('password'),
        ]);

        //Pessoa Jurídica
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@email.com',
            'document' => '12345678912345',
            'type' => 'pj',
            'balance' => '50.00',
            'password' => Hash::make('password'),
        ]);
    }
}
