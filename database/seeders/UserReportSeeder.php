<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserReport;
use App\Models\User;

class UserReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::select('id')->whereHas('roles', function ($query) {
                    return $query->where('name','!=', 'Administrator');
                })
        ->pluck('id')->toArray();
        foreach($users as $user){
            UserReport::factory(rand(1,25))->create(['user_id' => $user]);
        }
    }

}
