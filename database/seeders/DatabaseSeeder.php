<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Database\Seeders\RoleTableSeeder;
use Database\Seeders\UsersTableSeeder;


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
        $this-> call([
        // dien je alle seeders die je zou aanmaken automatisch toe te voegen aan de DatabaseSeeder.
        UsersTableSeeder::class,
        RoleTableSeeder::class
        ]);
    }
}
