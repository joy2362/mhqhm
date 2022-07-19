<?php
//@abdullah zahid joy
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->updateOrInsert(
            ['title' => 'Dashboard',  'icon' => "fa-solid fa-house"],
            ['route' => 'admin.dashboard']
        );

        DB::table('menus')->updateOrInsert(
            ['title' => 'Module', 'icon' => "fa-solid fa-star"],
            ['route' => 'admin.module']
        );

        DB::table('menus')->updateOrInsert(
            ['title' => 'Menu', 'icon' => "fa-solid fa-circle-check"],
            ['route' => 'admin.menu.index']
        );


        DB::table('menus')->updateOrInsert(
            ['title' => 'Activity Log', 'icon' => "fa-solid fa-clock-rotate-left"],
            ['route' => 'admin.activities']
        );

        DB::table('menus')->updateOrInsert(
            ['title' => 'Recycle Bin', 'icon' => "fa-solid fa-trash-can"],
            ['route' => 'admin.recycle.index']
        );

    }
}
