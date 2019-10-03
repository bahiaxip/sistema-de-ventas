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
        	"name" => "Edición de usuario",
        	"slug" => "users.edit",
        	"description" => "Editar cualquier usuario del sistema"
        ]);        
        Permission::create([
        	"name" => "Eliminar usuario",
        	"slug" => "users.destroy",
        	"description" => "Eliminar cualquier usuario del sistema"
        ]);
            //Roles
        Permission::create([
            "name" => "Navegar roles",
            "slug" => "roles.index",
            "description" => "lista y navega todos los roles del sistema"
        ]);
        Permission::create([
            "name" => "Ver detalle de rol",
            "slug" => "roles.show",
            "description" => "Ver en detalle cada rol del sistema"
        ]);
        Permission::create([
            "name" => "Crear rol",
            "slug" => "roles.create",
            "description" => "Crear cualquier rol del sistema"
        ]);
        Permission::create([
            "name" => "Edición de rol",
            "slug" => "roles.edit",
            "description" => "Editar cualquier rol del sistema"
        ]);
        Permission::create([
            "name" => "Eliminar rol",
            "slug" => "roles.destroy",
            "description" => "Eliminar cualquier rol del sistema"
        ]);

        //Vendedores
        Permission::create([
            "name" => "Navegar vendedores",
            "slug" => "vendedores.index",
            "description" => "lista y navega todos los vendedores del sistema"
        ]);
        Permission::create([
            "name" => "Ver detalle de vendedor",
            "slug" => "vendedores.show",
            "description" => "Ver en detalle cada vendedor del sistema"
        ]);
        Permission::create([
            "name" => "Crear vendedor",
            "slug" => "vendedores.create",
            "description" => "Crear cualquier vendedor del sistema"
        ]);
        Permission::create([
            "name" => "Edición de vendedor",
            "slug" => "vendedores.edit",
            "description" => "Editar cualquier vendedor del sistema"
        ]);
        Permission::create([
            "name" => "Eliminar vendedor",
            "slug" => "vendedores.destroy",
            "description" => "Eliminar cualquier vendedor del sistema"
        ]);
        //Supervisores
        Permission::create([
            "name" => "Navegar supervisores",
            "slug" => "supervisores.index",
            "description" => "lista y navega todos los supervisores del sistema"
        ]);
        Permission::create([
            "name" => "Ver detalle de supervisor",
            "slug" => "supervisores.show",
            "description" => "Ver en detalle cada supervisor del sistema"
        ]);
        Permission::create([
            "name" => "Crear supervisor",
            "slug" => "supervisores.create",
            "description" => "Crear cualquier supervisor del sistema"
        ]);
        Permission::create([
            "name" => "Edición de supervisor",
            "slug" => "supervisores.edit",
            "description" => "Editar cualquier supervisor del sistema"
        ]);
        Permission::create([
            "name" => "Eliminar supervisor",
            "slug" => "supervisores.destroy",
            "description" => "Eliminar cualquier supervisor del sistema"
        ]);
        


    }
}
