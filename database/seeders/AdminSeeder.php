<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@imsscholarships.com'], // Match existing admin by email
            [
                'id' => DB::table('users')->where('email', 'admin@imsscholarships.com')->value('id') ?? Str::uuid(), // Preserve existing ID or generate a new one
                'name' => "Super Admin",
                'password' => Hash::make('@Imsscholarships2024'),
                'status' => "active",
                'user_type' => "super-admin"
            ]
        );
    }
}
