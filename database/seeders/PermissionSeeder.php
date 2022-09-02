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
            ['name'=>'index dashboard','guard_name'=>'admin','group_name' => 'dashboard'],
            ['name'=>'index module','guard_name'=>'admin','group_name' => 'module'],

            ['name'=>'index menu','guard_name'=>'admin','group_name' => 'menu'],
            ['name'=>'edit menu','guard_name'=>'admin','group_name' => 'menu'],
            ['name'=>'update menu','guard_name'=>'admin','group_name' => 'menu'],

            ['name'=>'index activity-log','guard_name'=>'admin','group_name' => 'activity-log'],

            ['name'=>'index user','guard_name'=>'admin','group_name' => 'user'],
            ['name'=>'create user','guard_name'=>'admin','group_name' => 'user'],
            ['name'=>'store user','guard_name'=>'admin','group_name' => 'user'],
            ['name'=>'show user','guard_name'=>'admin','group_name' => 'user'],
            ['name'=>'edit user','guard_name'=>'admin','group_name' => 'user'],
            ['name'=>'update user','guard_name'=>'admin','group_name' => 'user'],
            ['name'=>'destroy user','guard_name'=>'admin','group_name' => 'user'],
            ['name'=>'update status user','guard_name'=>'admin','group_name' => 'user'],

            ['name'=>'index recycle','guard_name'=>'admin','group_name' => 'recycle'],
            ['name'=>'recover recycle','guard_name'=>'admin','group_name' => 'recycle'],
            ['name'=>"delete recycle",'guard_name'=>'admin','group_name' => 'recycle'],

            ['name'=>"index setting",'guard_name'=>'admin','group_name' => 'setting'],
            ['name'=>"update setting",'guard_name'=>'admin','group_name' => 'setting'],
            ['name'=>"update logos",'guard_name'=>'admin','group_name' => 'setting'],

            ['name'=>"index admin-role",'guard_name'=>'admin','group_name' => 'admin-role'],
            ['name'=>"create admin-role",'guard_name'=>'admin','group_name' => 'admin-role'],
            ['name'=>"store admin-role",'guard_name'=>'admin','group_name' => 'admin-role'],
            ['name'=>"show admin-role",'guard_name'=>'admin','group_name' => 'admin-role'],
            ['name'=>"edit admin-role",'guard_name'=>'admin','group_name' => 'admin-role'],
            ['name'=>"update admin-role",'guard_name'=>'admin','group_name' => 'admin-role'],
            ['name'=>"destroy admin-role",'guard_name'=>'admin','group_name' => 'admin-role'],

            ['name'=>"index user-role",'guard_name'=>'admin','group_name' => 'user-role'],
            ['name'=>"create user-role",'guard_name'=>'admin','group_name' => 'user-role'],
            ['name'=>"store user-role",'guard_name'=>'admin','group_name' => 'user-role'],
            ['name'=>"show user-role",'guard_name'=>'admin','group_name' => 'user-role'],
            ['name'=>"edit user-role",'guard_name'=>'admin','group_name' => 'user-role'],
            ['name'=>"update user-role",'guard_name'=>'admin','group_name' => 'user-role'],
            ['name'=>"destroy user-role",'guard_name'=>'admin','group_name' => 'user-role'],
        ];
        foreach($permissions as $permission){
            Permission::updateOrCreate(
                $permission
            );
        }

        foreach ($modules as $module){
            Permission::updateOrCreate(
                ['name' => 'show ' .lcfirst($module->name)] ,
                ['guard_name'=>'admin','group_name'=>lcfirst($module->name)]
            );

            Permission::updateOrCreate(
                ['name' => 'index ' .lcfirst($module->name)] ,
                ['guard_name'=>'admin','group_name'=>lcfirst($module->name)]
            );

            Permission::updateOrCreate(
                ['name' => 'create ' .lcfirst($module->name)] ,
                ['guard_name'=>'admin','group_name'=>lcfirst($module->name)]
            );

            Permission::updateOrCreate(
                ['name' => 'edit ' .lcfirst($module->name)] ,
                ['guard_name'=>'admin','group_name'=>lcfirst($module->name)]
            );

            Permission::updateOrCreate(
                ['name' => 'destroy ' .lcfirst($module->name)] ,
                ['guard_name'=>'admin','group_name'=>lcfirst($module->name)]
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
