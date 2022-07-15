<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0){
            User::updateOrCreate(
                ['name' => "Abdullah zahid joy",
                    'password' => Hash::make('123456')],
                ['email' => "abdullahzahidjoy@gmail.com"]);
        }
    }
}
