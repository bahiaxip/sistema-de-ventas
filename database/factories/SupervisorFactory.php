<?php

use Faker\Generator as Faker;

$factory->define(App\Supervisor::class, function (Faker $faker) {
	$random=mt_rand(10000000,99999999);
    return [
        "nombre" => $faker->firstName,
        "apellidos" => $faker->name,
        "telefono" => $random,
        "correo" =>$faker->unique()->safeEmail,
    ];
});
