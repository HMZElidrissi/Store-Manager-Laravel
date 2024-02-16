<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->create();
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'Amine Ismaili',
            'email' => 'amine@amine.com',
            'password' => bcrypt('amine'),
            'role_id' => 2,
        ]);
        DB::table('users')->insert([
            'name' => 'Rania Bouabid',
            'email' => 'rania@rania.com',
            'password' => bcrypt('rania'),
            'role_id' => 3,
        ]);
    }
}
