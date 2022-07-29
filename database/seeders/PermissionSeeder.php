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
          ['name'=>'Create Module','guard_name'=>'admin'],
          ['name'=>'View All Menu','guard_name'=>'admin'],
          ['name'=>'View All Dashboard','guard_name'=>'admin'],
          ['name'=>'Edit Menu','guard_name'=>'admin'],
          ['name'=>'View All Activity Log','guard_name'=>'admin'],
          ['name'=>'View All User','guard_name'=>'admin'],
          ['name'=>'Delete User','guard_name'=>'admin'],
          ['name'=>'Update User Status','guard_name'=>'admin'],
          ['name'=>'View All Recycle Bin','guard_name'=>'admin'],
          ['name'=>'Recover From Recycle Bin','guard_name'=>'admin'],
          ['name'=>"Destroy From Recycle Bin",'guard_name'=>'admin'],
          ['name'=>"View All Setting",'guard_name'=>'admin'],
          ['name'=>"Update Setting",'guard_name'=>'admin'],
          ['name'=>"Update Logos",'guard_name'=>'admin'],
          ['name'=>"View All Role",'guard_name'=>'admin'],
          ['name'=>"Create Role",'guard_name'=>'admin'],
          ['name'=>"Edit Role",'guard_name'=>'admin'],
          ['name'=>"Delete Role",'guard_name'=>'admin'],
        ];
        foreach($permissions as $permission){
            Permission::updateOrCreate(
                $permission
            );
        }

        foreach ($modules as $module){
            Permission::updateOrCreate(
                ['name' => 'View ' .ucfirst($module->name)] ,
                ['guard_name'=>'admin']
            );

            Permission::updateOrCreate(
                ['name' => 'View All ' .ucfirst($module->name)] ,
                ['guard_name'=>'admin']
            );

            Permission::updateOrCreate(
                ['name' => 'Create ' .ucfirst($module->name)] ,
                ['guard_name'=>'admin']
            );

            Permission::updateOrCreate(
                ['name' => 'Edit ' .ucfirst($module->name)] ,
                ['guard_name'=>'admin']
            );

            Permission::updateOrCreate(
                ['name' => 'Delete ' .ucfirst($module->name)] ,
                ['guard_name'=>'admin']
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
