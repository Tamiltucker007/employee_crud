<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Create an admin user */
        User::create([
            'name' => 'Admin',
            'email' => 'admin@creative.com',
            'password'=> bcrypt('123456'),
        ]);
    }
}
