<?php

use Faker\Generator as Faker;
use App\Cliente;
use App\Classes\Paises;

$factory->define(Cliente::class, function (Faker $faker) {
	$random=mt_rand(10000000,99999999);
    $paises=new Paises();
    $pais=$paises->all;
    $pais_aleatorio=$pais[array_rand($pais)];

    return [
        "nif"=>$random,
        "name" => $faker->firstName,
        "surname"=> $faker->name,
        "address"=>$faker->streetName,
        "province"=> $faker->city,
        "city"=>$faker->city,
        "country"=>$pais_aleatorio,
        "postal_code"=>$faker->postcode,
        "logo"=>$faker->imageUrl,
        "email"=>$faker->unique()->safeEmail,
        "phone"=>$faker->e164PhoneNumber,
        "fax"=> $faker->e164PhoneNumber,
        "cellphone"=>$faker->e164PhoneNumber,
        "web"=>$faker->domainName

    ];
});
