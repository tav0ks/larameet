<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'teste',
            'email' => 'teste@teste.com',
            'password' => '123123123'
        ]);

        // DB::table('meets')->insert([
        //     'name' => 'teste',
        //     'agenda' => ''
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => '',
        //     'email' => '',
        //     'password' => ''
        // ]);
    }
}
