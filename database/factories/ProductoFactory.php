<?php

use Faker\Generator as Faker;
use App\Producto;
$factory->define(Producto::class, function (Faker $faker) {
    return [
        "name"=>$faker->word,
        "product_model"=>$faker->word,
        "price"=>$faker->numberBetween(0,1000),
        "description"=>$faker->sentence(5,true),
        "stock"=>$faker->randomNumber(2),
        "category_id"=>$faker->numberBetween(1,2),
    ];
});
