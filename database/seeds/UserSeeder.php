<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,22)->create([]);
        App\User::create([
            "name" => "xip",
            "email" => "mundaxip@gmail.com",
            "password" => bcrypt("laravel")
        ]);

        Role::create([
        	"name" => "Admin",
        	"slug" => "admin",
        	"special" => "all-access"
        ]);
        Role::create([
           "name" => "Editor",
            "slug" => "editor",
            "description" => "Navegar, ver, crear, editar y eliminar categorías, etiquetas y entradas",            
        ]);
        Role::create([
           "name" => "Suscriptor",
            "slug" => "suscriptor",
            "description" => "Crear comentarios"
        ]);
    }
}
