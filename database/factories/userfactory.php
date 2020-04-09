<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\image;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'omasha',
        'email' => 'admin@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('12345678'), // password
        'remember_token' => Str::random(10),
    ];
});
