<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Article::factory(10)->create();
        Client::factory(5)->create();
        User::factory(5)->create();

        $this->call(DureeLocationSeeserTable::class);
        $this->call(PermissionSeederTable::class);
        $this->call(RoleSeederTable::class);
        $this->call(StatutLocationSeederTable::class);
        $this->call(TypeArticleSeederTable::class);

        User::find(1)->roles(1)->attach(1);
        User::find(2)->roles(2)->attach(2);
        User::find(2)->roles(2)->attach(3);
        User::find(3)->roles(3)->attach(3);

    }
}
