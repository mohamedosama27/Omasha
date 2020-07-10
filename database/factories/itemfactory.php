<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\item;

use Faker\Generator as Faker;

$factory->define(item::class, function (Faker $faker) {
    $x=$faker->randomDigit;
    return [
        'name'=>$faker->word,
        'barcode'=>$faker->word,
        'description'=>$faker->paragraph,
        'price'=>$x+5,
        'cost'=>$x,
        'quantity'=>$x+3,
	'product' => '0',
        

    ];
});
