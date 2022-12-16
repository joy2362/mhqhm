<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
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
              "name"=> "Class One",
              "bn_name"=> "ক্লাস ওয়ান",
              "arabic_name"=> "الدرجة الأولى",
            ],
            [
                "name"=> "Class Two",
                "bn_name"=> "ক্লাস টু",
                "arabic_name"=> "الدرجة الثانية",
            ],
            [
                "name"=> "Class Three",
                "bn_name"=> "ক্লাস থ্রি",
                "arabic_name"=> "الدرجة الثالثة",
            ],
        ];
        
        //{
        //    "id": "4",
        //    "name": "Class Four",
        //    "bn_name": "ক্লাস ফোর",
        //    "arabic_name": "الدرجة الرابعة",
        //    "created_by": null,
        //    "updated_by": null,
        //    "deleted_by": null,
        //    "deleted_at": null,
        //    "status": "active",
        //    "is_deleted": "no",
        //    "created_at": "2022-11-20 14:54:27",
        //    "updated_at": "2022-11-20 14:54:27"
        //},
        //{
        //    "id": "5",
        //    "name": "Class Five",
        //    "bn_name": "ক্লাস ফাইভ",
        //    "arabic_name": "الدرجة الخامسة",
        //    "created_by": null,
        //    "updated_by": null,
        //    "deleted_by": null,
        //    "deleted_at": null,
        //    "status": "active",
        //    "is_deleted": "no",
        //    "created_at": "2022-11-20 14:54:59",
        //    "updated_at": "2022-11-20 14:54:59"
        //},
        //{
        //    "id": "6",
        //    "name": "Nursery",
        //    "bn_name": "নার্সারি",
        //    "arabic_name": "حضانة",
        //    "created_by": null,
        //    "updated_by": null,
        //    "deleted_by": null,
        //    "deleted_at": null,
        //    "status": "active",
        //    "is_deleted": "no",
        //    "created_at": "2022-11-20 14:57:48",
        //    "updated_at": "2022-11-20 14:57:48"
        //},
        //{
        //    "id": "7",
        //    "name": "Nazera",
        //    "bn_name": "নাজেরা",
        //    "arabic_name": "نذرة",
        //    "created_by": null,
        //    "updated_by": null,
        //    "deleted_by": null,
        //    "deleted_at": null,
        //    "status": "active",
        //    "is_deleted": "no",
        //    "created_at": "2022-11-20 14:59:06",
        //    "updated_at": "2022-11-20 14:59:06"
        //},
        //{
        //    "id": "8",
        //    "name": "Hefzu",
        //    "bn_name": "হেফজু",
        //    "arabic_name": "هيفزو",
        //    "created_by": null,
        //    "updated_by": null,
        //    "deleted_by": null,
        //    "deleted_at": null,
        //    "status": "active",
        //    "is_deleted": "no",
        //    "created_at": "2022-11-20 15:02:10",
        //    "updated_at": "2022-11-20 15:02:10"
        //}
    }
}
