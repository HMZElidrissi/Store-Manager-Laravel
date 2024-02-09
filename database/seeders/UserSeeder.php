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
    }
}
