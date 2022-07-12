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
            ['title' => 'Dashboard',  'icon' => "home"],
            ['route' => 'admin.dashboard']
        );

        DB::table('menus')->updateOrInsert(
            ['title' => 'Module', 'icon' => "command"],
            ['route' => 'admin.module']
        );

    }
}
