<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DureeLocationSeeserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('duree_locations')->insert(
            ["libelle"=>"une journee","valeurEnHeure"=>24],
            ["libelle"=>"Demi-journee","valeurEnHeure"=>12],
        );
    }
}
