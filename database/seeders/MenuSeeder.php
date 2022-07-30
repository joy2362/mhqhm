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
            ['title' => 'Dashboard',  'icon' => "fa-solid fa-house" , 'sorting' => 1 ],
            ['route' => 'admin.dashboard.index']
        );

        DB::table('menus')->updateOrInsert(
            ['title' => 'Module', 'icon' => "fa-solid fa-star",'sorting' => 2],
            ['route' => 'admin.module.index']
        );

        DB::table('menus')->updateOrInsert(
            ['title' => 'Menu', 'icon' => "fa-solid fa-circle-check",'sorting' => 3],
            ['route' => 'admin.menu.index']
        );


        DB::table('menus')->updateOrInsert(
            ['title' => 'Activity-log', 'icon' => "fa-solid fa-clock-rotate-left",'sorting' => 4],
            ['route' => 'admin.activity-log.index']
        );

        DB::table('menus')->updateOrInsert(
            ['title' => 'Recycle', 'icon' => "fa-solid fa-trash-can",'sorting' => 6],
            ['route' => 'admin.recycle.index']
        );

        DB::table('menus')->updateOrInsert(
            ['title' => 'User', 'icon' => "fa-solid fa-user-group",'sorting' => 5],
            ['route' => 'admin.user.index']

        );

        DB::table('menus')->updateOrInsert(
            ['title' => 'Setting', 'icon' => "fa-solid fa-gears",'sorting' => 6],
            ['route' => 'admin.setting.index']

        );

        DB::table('menus')->updateOrInsert(
            ['title' => 'Admin-role', 'icon' => "fa-solid fa-user-gear",'sorting' => 7],
            ['route' => 'admin.admin-role.index']
        );

    }
}
