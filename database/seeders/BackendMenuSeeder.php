<?php

namespace Database\Seeders;

use App\Models\System\BackendMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BackendMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('backend_menus')->truncate();
        BackendMenu::insert([
            //id 1
            [
                'parent_id' => null,
                'title' => 'Dashboard',
                'icon' => "fa-solid fa-house" ,
                'sorting' => 1,
                'route' => 'Dashboard.index'

            ],
            //id 2
            [
                'parent_id' => null,
                'title' => 'Master Setup',
                'icon' => "fa-solid fa-globe" ,
                'sorting' => 2,
                'route' => null,
            ],

            //id 3
            [
                'parent_id' => null,
                'title' => 'User',
                'icon' => "fa-solid fa-user" ,
                'sorting' => 3,
                'route' => null,
            ],

            //id 4
            [
                'parent_id' => 3,
                'title' => 'User Role',
                'icon' => "fa-solid fa-user-shield",
                'sorting' => 1,
                'route' => 'UserRole.index'
            ],

            //id 5
            [
                'parent_id' => 3,
                'title' => 'User',
                'icon' => "fa-solid fa-user-group",
                'sorting' => 2,
                'route' => 'User.index'
            ],

            // id 6
            [
                'parent_id' => null,
                'title' => 'Admin',
                'icon' => "fa-solid fa-user-secret",
                'sorting' => 4,
                'route' => null,
            ],
            //id 7
            [
                'parent_id' => 6,
                'title' => 'Admin Role',
                'icon' => "fa-solid fa-user-gear",
                'sorting' => 1,
                'route' => 'AdminRole.index'
            ],
            //id 8
            [
                'parent_id' => 6,
                'title' => 'Admin',
                'icon' => "fa-solid fa-user-gear",
                'sorting' => 2,
                'route' => 'Admin.index'
            ],

            // id 9
            [
                'parent_id' => null,
                'title' => 'System Setting',
                'icon' => "fa-solid fa-gears",
                'sorting' => 4,
                'route' => null,
            ],
            //id 9
            [
                'parent_id' => 9,
                'title' => 'Module',
                'icon' => "fa-solid fa-star",
                'sorting' => 1,
                'route' => 'Module.index'
            ],
            //id 11
            [
                'parent_id' => 9,
                'title' => 'Setting',
                'icon' => "fa-solid fa-gears",
                'sorting' => 2,
                'route' => 'Setting.index'
            ],
            //id 12
            [
                'parent_id' => null,
                'title' => 'Recycle Bin',
                'icon' => "fa-solid fa-trash-can",
                'sorting' => 6,
                'route' => 'RecycleBin.index'
            ],
            //id 13
            [
                'parent_id' => null,
                'title' => 'Activity Log',
                'icon' => "fa-solid fa-clock-rotate-left",
                'sorting' => 4,
                'route' => 'ActivityLog.index'
            ],

            //id 14
//            [
//                'parent_id' => 2,
//                'title' => 'Category',
//                'icon' => "fa-solid fa-clock-rotate-left",
//                'sorting' => 1,
//                'route' => 'admin.category.index'
//            ],


        ]);
    }
}
