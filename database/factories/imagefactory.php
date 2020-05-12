<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\image;
use App\item;
use Faker\Generator as Faker;

$factory->define(image::class, function (Faker $faker) {
    $images=['11172.png','11355.jpeg','14121.jpeg','17057.jpeg','20468.jpeg','93106.jpeg','31240.jpeg'];
    $item=item::all()->random(1);
        // get random index from array $arrX
    $randIndex = array_rand($images);
    
    // output the value for the random index
     
    return [
        'name'=>$images[$randIndex],
        'item_id' => $item[0]->id,

    ];
});
