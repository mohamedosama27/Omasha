<?php

use Illuminate\Database\Seeder;
use App\item;
use App\image;
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
        factory(image::class,80)->create();
        // factory(item::class,100)->create();
    }
}
