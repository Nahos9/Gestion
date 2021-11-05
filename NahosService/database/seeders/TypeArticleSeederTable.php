<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TypeArticleSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_articles')->insert(
            ["nom"=> "voiture"],
            ["nom"=> "Immobilier"],
            ["nom"=> "Appareil Electronique"],
            ["nom"=> "Salle"],
        );

        DB::table('propriete_articles')->insert(
            ["nomPropriete"=>"Marque","type_article_id"=>1],
            ["nomPropriete"=>"Kilometrage","type_article_id"=>1],
            ["nomPropriete"=>"Superficie","type_article_id"=>2],
            ["nomPropriete"=>"Prix","type_article_id"=>2],
        );
    }
}
