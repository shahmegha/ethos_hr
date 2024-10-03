<?php

namespace Database\Seeders;

#use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = new Role;
        $roleAdmin->name = "Administrator";
        $roleAdmin->guard_name = "web";
        $roleAdmin->save(); 
        
        $roleGuest = new Role;
        $roleGuest->name = "Guest";
        $roleGuest->guard_name = "web";
        $roleGuest->save(); 
    }
}
