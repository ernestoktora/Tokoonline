<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::create([
            'name' => 'Tomokazu',
            'email' => 'admin@admin.com',
            'role' => '1',
            'status' => 1,
            'hp' => '0812345678901',
            'password' => bcrypt('P@55word'),
        ]);
            User::create([
                'name' => 'Sopian Aji',
                'email' => 'sopianaji@gmail.com',
                'role' => '0',
                'status' => 1,
                'hp' => '081234567892',
                'password' => bcrypt('P@55word'),
            ]);
    }
}
