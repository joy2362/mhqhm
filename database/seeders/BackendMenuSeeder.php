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

        BackendMenu::query()->truncate();
        $menus = [
            [
                'parent_id' => null,
                'title' => 'Dashboard',
                'icon' => "fa-solid fa-house" ,
                'sorting' => 1,
                'route' => 'Dashboard.index'

            ],
            [
                'parent_id' => null,
                'title' => 'Master Setup',
                'icon' => "fa-solid fa-globe" ,
                'sorting' => 2,
                'route' => null,
            ],
            [
                'parent_id' => null,
                'title' => 'Student',
                'icon' => "fa-solid fa-user" ,
                'sorting' => 3,
                'route' => null,
            ],
            [
                'parent_id' => null,
                'title' => 'Fee',
                'icon' => "fa-solid fa-user" ,
                'sorting' => 4,
                'route' => null,
            ],
            [
                'parent_id' => null,
                'title' => 'Admin',
                'icon' => "fa-solid fa-user-secret",
                'sorting' => 5,
                'route' => null,
            ],
            [
                'parent_id' => null,
                'title' => 'Donation',
                'icon' => "fa-solid fa-hand-holding-dollar",
                'sorting' => 6,
                'route' => "Donation.index",
            ],
            [
                'parent_id' => null,
                'title' => 'System Setting',
                'icon' => "fa-solid fa-gears",
                'sorting' => 7,
                'route' => null,
            ],
            [
                'parent_id' => null,
                'title' => 'Recycle Bin',
                'icon' => "fa-solid fa-trash-can",
                'sorting' => 8,
                'route' => 'RecycleBin.index'
            ],

        ];
        foreach ($menus as $menu){
            if(empty(BackendMenu::where('title',$menu['title'])->first())){
                BackendMenu::firstOrCreate($menu);
            }
        }

        $adminSub = [
            [
                'title' => 'Admin Role',
                'icon' => "fa-solid fa-user-gear",
                'sorting' => 1,
                'route' => 'AdminRole.index'
            ],
            [
                'title' => 'Admin',
                'icon' => "fa-solid fa-user-gear",
                'sorting' => 2,
                'route' => 'Admin.index'
            ],
        ];
        $userSub = [
            [
                'title' => 'Admission',
                'icon' => "fa-solid fa-user-plus",
                'sorting' => 1,
                'route' => 'User.create'
            ],
            [
                'title' => 'All Student',
                'icon' => "fa-solid fa-user-group",
                'sorting' => 2,
                'route' => 'User.index'
            ],
        ];
        $settingSub = [
            [
                'title' => 'Module',
                'icon' => "fa-solid fa-star",
                'sorting' => 1,
                'route' => 'Module.index'
            ],
            [
                'title' => 'Setting',
                'icon' => "fa-solid fa-gears",
                'sorting' => 2,
                'route' => 'Setting.index'
            ],
            [
                'title' => 'Activity Log',
                'icon' => "fa-solid fa-clock-rotate-left",
                'sorting' => 4,
                'route' => 'ActivityLog.index'
            ],
        ];
        $masterSub = [
            [
                'title' => 'Group',
                'icon' => "fa-solid fa-users-rectangle",
                'sorting' => 1,
                'route' => 'Group.index'
            ],
            [
                'title' => 'Fee Type',
                'icon' => "fa-solid fa-comments-dollar",
                'sorting' => 2,
                'route' => 'FeeType.index'
            ],

            [
                'title' => 'Fee',
                'icon' => "fa-solid fa-comments-dollar",
                'sorting' => 3,
                'route' => 'Fee.index'
            ],
            [
                'title' => 'Subject',
                'icon' => "fa-solid fa-comments-dollar",
                'sorting' => 4,
                'route' => 'Subject.index'
            ],
            [
                'title' => 'Group Subject',
                'icon' => "fa-solid fa-users-rectangle",
                'sorting' => 4,
                'route' => 'GroupSubject.index'
            ],

        ];
        $feeSub = [
            [
                'title' => 'Payment',
                'icon' => "fa-solid fa-users-rectangle",
                'sorting' => 1,
                'route' => 'Payment.index'
            ]
        ];

        //create sub menu
        BackendMenu::where("title","Student")->first()->subMenu()->createMany($userSub);
        BackendMenu::where("title","Admin")->first()->subMenu()->createMany($adminSub);
        BackendMenu::where("title","System Setting")->first()->subMenu()->createMany($settingSub);
        BackendMenu::where("title","Master Setup")->first()->subMenu()->createMany($masterSub);
    }
}
