<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\UserReportSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
           // RolesSeeder::class,
           // AdminUserSeeder::class,
           // UsersSeeder::class,
            UserReportSeeder::class
        ]);
        
    }
}
