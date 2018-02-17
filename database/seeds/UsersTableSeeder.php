<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Admin Ganteng',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('rahasia'),
            'level' => User::ACCESS_ADMIN,
            'api_token' => '3ad12acc-80d4-3f50-93fa-e70d30947f19'
        ]);

        factory(User::class)->create([
            'name' => 'Budi',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('rahasia'),
            'level' => User::ACCESS_MEMBER,
            'api_token' => 'f640f7d0-f7b3-3991-96d1-5df1b5f3fe6d'
        ]);

        factory(User::class)->create([
            'name' => 'Dadang',
            'email' => 'dadang@gmail.com',
            'password' => bcrypt('rahasia'),
            'level' => User::ACCESS_MEMBER,
            'api_token' => '820b0341-7a01-3a40-ac3c-9160b69d8c8b'
        ]);
    }
}
