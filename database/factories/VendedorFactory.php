<?php

use Faker\Generator as Faker;


$factory->define(App\Vendedor::class, function (Faker $faker) {
    //mt_rand(min,max)
    //random_int(min,max) criptográficamente seguros 
    $random=mt_rand(10000000,99999999);
    //$random=random_int(10000000,99999999);
    return [
        "name" => $faker->firstName,
        //"apellidos" => $faker->lastName,
        "surname" => $faker->name,
        "phone" => $random,
        "email" =>$faker->unique()->safeEmail,
        //id_supervisor requiere un id de supervisor así que
        //creamos el factory de supervisor y añadimos el id
        "id_supervisor" => function(){
        	return factory(App\Supervisor::class)->create()->id;
        }
    ];
});
