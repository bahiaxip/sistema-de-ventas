<?php

use Faker\Generator as Faker;
use App\Producto;
$factory->define(Producto::class, function (Faker $faker) {
    return [
        "name"=>$faker->word,
        "model"=>$faker->word,
        "price"=>$faker->numberBetween(0,1000),
        "description"=>$faker->sentence(5,true),
        "stock"=>$faker->randomNumber(2),
    ];
});
