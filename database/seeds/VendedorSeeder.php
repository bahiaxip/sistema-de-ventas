<?php

use Illuminate\Database\Seeder;
use App\Vendedor;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/*Vendedor::create([
    		"nombre" => "Matias",
    		"apellidos" => "Jimenez"
    	]);*/
        factory(Vendedor::class,20)->create([]);
    }
}
