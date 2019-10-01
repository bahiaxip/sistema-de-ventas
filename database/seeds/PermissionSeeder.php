<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users Acceso a usuarios
        Permission::create([
    		"name" => "Navegar usuarios",
    		"slug" => "users.index",
    		"description" => "Lista y navega todos los usuarios del sistema",
        ]);

        Permission::create([
        	"name" => "Ver detalle de usuario",
        	"slug" => "users.show",
        	"description" => "Ver en detalle cada usuario del sistema"
        ]);
        Permission::create([
        	"name" => "Edición de usuarios",
        	"slug" => "users.edit",
        	"description" => "Ver en detalle cada usuario del sistema"
        ]);
        Permission::create([
        	"name" => "Eliminar usuario",
        	"slug" => "users.destroy",
        	"description" => "Eliminar cualquier usuario del sistema"
        ]);

    }
}
