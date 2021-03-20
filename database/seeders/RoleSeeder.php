<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $json = File::get("database/data/role.json");
        $data = json_decode($json);
        foreach($data as $obj){
            Role::create(array(
                'name' => $obj->name,
            ));
        }
    }
}
