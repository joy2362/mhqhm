<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                "name"=> "Hefzu",
                "bn_name"=> "হেফজু",
            ],
            [
                "name"=> "Arabic",
                "bn_name"=> "আরবি",
            ],
            [
                "name"=> "Bangla",
                "bn_name"=> "বাংলা",
            ],
            [
                "name"=> "English",
                "bn_name"=> "ইংরেজি",
            ],
            [
                "name"=> "Math",
                "bn_name"=> "গণিত",
            ],
            [
                "name"=> "General knowledge",
                "bn_name"=> "সাধারণ জ্ঞান",
            ],
            [
                "name"=> "World identity",
                "bn_name"=> "বিশ্ব পরিচয়",
            ],
            [
                "name"=> "Science",
                "bn_name"=> "বিশ্ব পরিচয়",
            ],
            [
                "name"=> "Quran",
                "bn_name"=> "কুরআন",
            ],

        ];
        if (Subject::count() < 1){
            Subject::insert($data);
        }
    }
}
