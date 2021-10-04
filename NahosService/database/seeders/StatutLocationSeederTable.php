<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class StatutLocationSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("statut_locations")->insert([
            ["nomStatut"=>"En attente"],
            ["nomStatut"=>"En cours"],
            ["nomStatut"=>"Terminée"],
        ]);
    }
}
