<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $json = File::get("database/data/user.json");
        $data = json_decode($json);
        foreach($data as $obj){
            User::create(array(
                'name' => $obj->name,
                'email' => $obj->email,
                'password' => Hash::make($obj->password),
                'role_id' => $obj->role_id,
            ));
        }
    }
}
