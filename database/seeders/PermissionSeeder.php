<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = DB::table('modules')->get();
        $permissions = [
            ['name'=>'index Dashboard','guard_name'=>'admin','group_name' => 'Dashboard'],
            ['name'=>'index Module','guard_name'=>'admin','group_name' => 'Module'],
            ['name'=>'store Module','guard_name'=>'admin','group_name' => 'Module'],
            
            ['name'=>'index ActivityLog','guard_name'=>'admin','group_name' => 'ActivityLog'],

            ['name'=>'index User','guard_name'=>'admin','group_name' => 'User'],
            ['name'=>'create User','guard_name'=>'admin','group_name' => 'User'],
            ['name'=>'store User','guard_name'=>'admin','group_name' => 'User'],
            ['name'=>'show User','guard_name'=>'admin','group_name' => 'User'],
            ['name'=>'edit User','guard_name'=>'admin','group_name' => 'User'],
            ['name'=>'update User','guard_name'=>'admin','group_name' => 'User'],
            ['name'=>'destroy user','guard_name'=>'admin','group_name' => 'User'],
            ['name'=>'changeStatus User','guard_name'=>'admin','group_name' => 'User'],

            ['name'=>'index Admin','guard_name'=>'admin','group_name' => 'Admin'],
            ['name'=>'create Admin','guard_name'=>'admin','group_name' => 'Admin'],
            ['name'=>'store Admin','guard_name'=>'admin','group_name' => 'Admin'],
            ['name'=>'show Admin','guard_name'=>'admin','group_name' => 'Admin'],
            ['name'=>'edit Admin','guard_name'=>'admin','group_name' => 'Admin'],
            ['name'=>'update Admin','guard_name'=>'admin','group_name' => 'Admin'],
            ['name'=>'destroy Admin','guard_name'=>'admin','group_name' => 'Admin'],

            ['name'=>'index RecycleBin','guard_name'=>'admin','group_name' => 'RecycleBin'],
            ['name'=>'recover RecycleBin','guard_name'=>'admin','group_name' => 'RecycleBin'],
            ['name'=>"delete RecycleBin",'guard_name'=>'admin','group_name' => 'RecycleBin'],

            ['name'=>"index Setting",'guard_name'=>'admin','group_name' => 'Setting'],
            ['name'=>"store Setting",'guard_name'=>'admin','group_name' => 'Setting'],
            ['name'=>"destroy Setting",'guard_name'=>'admin','group_name' => 'Setting'],
            ['name'=>"update Setting",'guard_name'=>'admin','group_name' => 'Setting'],

            ['name'=>"index AdminRole",'guard_name'=>'admin','group_name' => 'AdminRole'],
            ['name'=>"create AdminRole",'guard_name'=>'admin','group_name' => 'AdminRole'],
            ['name'=>"store AdminRole",'guard_name'=>'admin','group_name' => 'AdminRole'],
            ['name'=>"show AdminRole",'guard_name'=>'admin','group_name' => 'AdminRole'],
            ['name'=>"edit AdminRole",'guard_name'=>'admin','group_name' => 'AdminRole'],
            ['name'=>"update AdminRole",'guard_name'=>'admin','group_name' => 'AdminRole'],
            ['name'=>"destroy AdminRole",'guard_name'=>'admin','group_name' => 'AdminRole'],

            ['name'=>"index UserRole",'guard_name'=>'admin','group_name' => 'user-role'],
            ['name'=>"create UserRole",'guard_name'=>'admin','group_name' => 'user-role'],
            ['name'=>"store UserRole",'guard_name'=>'admin','group_name' => 'user-role'],
            ['name'=>"show UserRole",'guard_name'=>'admin','group_name' => 'user-role'],
            ['name'=>"edit UserRole",'guard_name'=>'admin','group_name' => 'user-role'],
            ['name'=>"update UserRole",'guard_name'=>'admin','group_name' => 'user-role'],
            ['name'=>"destroy UserRole",'guard_name'=>'admin','group_name' => 'user-role'],
        ];
        foreach($permissions as $permission){
            Permission::updateOrCreate(
                $permission
            );
        }

        foreach ($modules as $module){
            Permission::updateOrCreate(
                ['name' => 'show ' . $module->name] ,
                ['guard_name'=>'admin','group_name'=> $module->name]
            );

            Permission::updateOrCreate(
                ['name' => 'index ' . $module->name] ,
                ['guard_name'=>'admin','group_name'=> $module->name]
            );

            Permission::updateOrCreate(
                ['name' => 'create ' . $module->name] ,
                ['guard_name'=>'admin','group_name'=> $module->name]
            );

            Permission::updateOrCreate(
                ['name' => 'edit ' . $module->name] ,
                ['guard_name'=>'admin','group_name'=> $module->name]
            );

            Permission::updateOrCreate(
                ['name' => 'destroy ' . $module->name] ,
                ['guard_name'=>'admin','group_name'=> $module->name]
            );

            Permission::updateOrCreate(
                ['name' => 'store ' . $module->name] ,
                ['guard_name'=>'admin','group_name'=> $module->name]
            );
        }

        $role = Role::where('name','Super Admin')->first();
        if(!empty($role)){
            $role->givePermissionTo(Permission::all());
        }
        $admin = Admin::where('email','abdullahzahidjoy@gmail.com')->first();
        if(!empty($admin)){
           $admin->assignRole('Super Admin');
        }

    }
}
