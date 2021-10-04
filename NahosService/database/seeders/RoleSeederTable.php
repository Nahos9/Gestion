<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class RoleSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("roles")->insert([
            ["nomRole"=>"superadmin"],
            ["nomRole"=>"admin"],
            ["nomRole"=>"manager"],
            ["nomRole"=>"employe"]
        ]);
    }
}
