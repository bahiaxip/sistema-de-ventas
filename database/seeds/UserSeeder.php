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
        //añadimos el user xip, los 3 roles y asignamos el rol admin al usuario xip
        App\User::create([
            "name" => "xip",
            "email" => "mundaxip@gmail.com",
            "password" => bcrypt("laravel")
        ]);

        Role::create([
        	"name" => "Admin",
        	"slug" => "admin",
            "description"=>"Acceso Total",
        	"special" => "all-access"
        ]);        
        Role::create([
           "name" => "Editor",
            "slug" => "editor",
            "description" => "Navegar, ver, crear, editar y eliminar categorías, productos,supervisores,vendedores,clientes,destinatarios, ventas y facturas",            
        ]);
        Role::create([
            "name" => "Creador",
            "slug" => "creador",
            "description" => "Navegar,ver y crear categorías, productos,supervisores,vendedores,clientes,destinatarios, ventas y facturas"
        ]);
        Role::create([
           "name" => "Suscriptor",
            "slug" => "suscriptor",
            "description" => "Navegar categorías, productos,supervisores,vendedores,clientes,destinatarios, ventas y facturas"
        ]);
        //rol temporal para user temporal (xip) con el role admin
        DB::table("role_user")->insert([
            "role_id"=> 1,
            "user_id"=>23
        ]);
//Asignamos permisos a los roles anteriores por defecto, si se modifican
//los permisos pueden no coincidir los permission_id y cambiarse los permisos o dar error el migrate

        //Asignamos permisos de Suscriptor por defecto
        DB::table("permission_role")->insert([
            "permission_id"=>10,
            "role_id"=>4
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>15,
            "role_id"=>4
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>20,
            "role_id"=>4
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>25,
            "role_id"=>4
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>30,
            "role_id"=>4
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>35,
            "role_id"=>4
        ]);        
        //Asignamos permisos de Creador por defecto
        DB::table("permission_role")->insert([
            "permission_id"=>10,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>11,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>12,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>15,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>16,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>17,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>20,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>21,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>22,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>25,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>26,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>27,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>30,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>31,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>32,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>35,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>36,
            "role_id"=>3
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>37,
            "role_id"=>3
        ]);        
        //Asignamos permisos de Editor por defecto
        DB::table("permission_role")->insert([
            "permission_id"=>10,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>11,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>12,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>13,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>14,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>15,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>16,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>17,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>18,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>19,
            "role_id"=>2        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>20,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>21,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>22,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>23,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>24,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>25,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>26,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>27,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>28,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>29,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>30,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>31,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>32,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>33,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>34,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>35,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>36,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>37,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>38,
            "role_id"=>2
        ]);
        DB::table("permission_role")->insert([
            "permission_id"=>39,
            "role_id"=>2
        ]);        
    }

}
