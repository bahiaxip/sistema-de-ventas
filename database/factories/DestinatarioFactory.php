<?php

use Faker\Generator as Faker;
use App\Destinatario;
use App\Classes\Paises;

$factory->define(Destinatario::class, function (Faker $faker) {
	$paises=new Paises();
	$pais=$paises->all;
	$pais_aleatorio=$pais[array_rand($pais)];
    return [
        "name"=>$faker->firstName,
        "surname"=>$faker->name,
        "country"=>$pais_aleatorio,
        "province"=>$faker->city,
        "city"=>$faker->city,
        "address"=>$faker->streetName,
        "postal_code"=>$faker->postcode,
        "email"=>$faker->safeEmail,
        "phone"=>$faker->e164PhoneNumber,        
        "fax"=>$faker->e164PhoneNumber,
        "cellphone"=>$faker->e164PhoneNumber
    ];
});
