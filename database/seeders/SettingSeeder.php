<?php

namespace Database\Seeders;

use App\Models\System\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $setting =  Setting::all()->count();
       if($setting == 0){
           Setting::create([
               'name' => 'CMS',
               'short_name' => 'CMS',
               'email' => 'abdullahzahidjoy@gmail.com',
               'phone' => '01780134797',
               'address' => '145/3-1 matikhata dhaka cantonment dhaka-1206',
               'footer_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
           ]);
       }
    }
}
