<?php

use Illuminate\Database\Seeder;
use App\item;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(item::class,1000)->create();
    }
}
