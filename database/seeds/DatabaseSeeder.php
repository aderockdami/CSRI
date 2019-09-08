<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Model\Phases;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,1)->create();
        factory(Phases::class,1)->create(["name" => "Identify"]);
        factory(Phases::class,1)->create(["name" => "Protect"]);
        factory(Phases::class,1)->create(["name" => "Detect"]);
        factory(Phases::class,1)->create(["name" => "Respond"]);
        factory(Phases::class,1)->create(["name" => "Recover"]);
    }
}
