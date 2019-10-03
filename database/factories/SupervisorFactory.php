<?php

use Faker\Generator as Faker;

$factory->define(App\Supervisor::class, function (Faker $faker) {
	$random=mt_rand(10000000,99999999);
    return [
        "name" => $faker->firstName,
        "surname" => $faker->name,
        "phone" => $random,
        "email" =>$faker->unique()->safeEmail,
    ];
});
