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

        //Clientes y destinatarios
        Permission::create([
            "name" => "Navegar clientes y destinatarios",
            "slug" => "clientes.index",
            "description" => "lista y navega todos los clientes y destinatarios del sistema"
        ]);
        Permission::create([
            "name" => "Ver detalle de cliente y de destinatario",
            "slug" => "clientes.show",
            "description" => "Ver en detalle cada cliente y destinatario del sistema"
        ]);
        Permission::create([
            "name" => "Crear cliente y destinatario",
            "slug" => "clientes.create",
            "description" => "Crear cualquier cliente y cualquier destinatario del sistema"
        ]);
        Permission::create([
            "name" => "Edición de cliente y destinatario",
            "slug" => "clientes.edit",
            "description" => "Editar cualquier cliente y cualquier destinatario del sistema"
        ]);
        Permission::create([
            "name" => "Eliminar cliente y destinatario",
            "slug" => "clientes.destroy",
            "description" => "Eliminar cualquier cliente y cualquier destinatario del sistema"
        ]);

        //Destinatarios omitido (adjuntado con clientes)
        /*
        Permission::create([
            "name" => "Navegar destinatarios",
            "slug" => "destinatarios.index",
            "description" => "lista y navega todos los destinatarios del sistema"
        ]);
        Permission::create([
            "name" => "Ver detalle de destinatario",
            "slug" => "destinatarios.show",
            "description" => "Ver en detalle cada destinatario del sistema"
        ]);
        Permission::create([
            "name" => "Crear destinatario",
            "slug" => "destinatarios.create",
            "description" => "Crear cualquier destinatario del sistema"
        ]);
        Permission::create([
            "name" => "Edición de destinatario",
            "slug" => "destinatarios.edit",
            "description" => "Editar cualquier destinatario del sistema"
        ]);
        Permission::create([
            "name" => "Eliminar destinatario",
            "slug" => "destinatarios.destroy",
            "description" => "Eliminar cualquier destinatario del sistema"
        ]);
        */

        //Productos
        Permission::create([
            "name" => "Navegar productos",
            "slug" => "productos.index",
            "description" => "lista y navega todos los productos del sistema"
        ]);
        Permission::create([
            "name" => "Ver detalle de producto",
            "slug" => "productos.show",
            "description" => "Ver en detalle cada producto del sistema"
        ]);
        Permission::create([
            "name" => "Crear producto",
            "slug" => "productos.create",
            "description" => "Crear cualquier producto del sistema"
        ]);
        Permission::create([
            "name" => "Edición de producto",
            "slug" => "productos.edit",
            "description" => "Editar cualquier producto del sistema"
        ]);
        Permission::create([
            "name" => "Eliminar producto",
            "slug" => "productos.destroy",
            "description" => "Eliminar cualquier producto del sistema"
        ]);
        //Categorías
        Permission::create([
            "name" => "Navegar categorías",
            "slug" => "categorias.index",
            "description" => "lista y navega todos los categorías del sistema"
        ]);
        Permission::create([
            "name" => "Ver detalle de categoría",
            "slug" => "categorias.show",
            "description" => "Ver en detalle cada categoría del sistema"
        ]);
        Permission::create([
            "name" => "Crear categoría",
            "slug" => "categorias.create",
            "description" => "Crear cualquier categoría del sistema"
        ]);
        Permission::create([
            "name" => "Edición de categoría",
            "slug" => "categorias.edit",
            "description" => "Editar cualquier categoría del sistema"
        ]);
        Permission::create([
            "name" => "Eliminar categoría",
            "slug" => "categorias.destroy",
            "description" => "Eliminar cualquier categoría del sistema"
        ]);

        //Ventas y facturas
        Permission::create([
            "name" => "Navegar ventas y facturas",
            "slug" => "ventas.index",
            "description" => "lista y navega todas las ventas y facturas del sistema"
        ]);
        Permission::create([
            "name" => "Ver detalle de venta y detalle de factura",
            "slug" => "ventas.show",
            "description" => "Ver en detalle cada venta y cada factura del sistema"
        ]);
        Permission::create([
            "name" => "Crear venta y factura",
            "slug" => "ventas.create",
            "description" => "Crear cualquier venta y cualquier factura del sistema"
        ]);
        Permission::create([
            "name" => "Edición de venta y factura",
            "slug" => "ventas.edit",
            "description" => "Editar cualquier venta y cualquier factura del sistema"
        ]);
        Permission::create([
            "name" => "Eliminar venta y factura",
            "slug" => "ventas.destroy",
            "description" => "Eliminar cualquier venta y cualquier factura del sistema"
        ]);

    }
}
