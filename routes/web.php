<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Exports\FacturasExport;


Route::get('/', function () {
    return view('index');
})->name("/");
//Exportar factura a Excel
Route::get("exportar/{id}","FacturasController@export")->name("exportar");
//Exportar factura a PDF
Route::get("/exportarPDF/{id}","FacturasController@exportPDF")->name("exportarPDF");
//Route::get("vendedores","VendedoresController@show")->name("vendedores");
//Enviar correo de factura
Route::post("exportarEmail","FacturasController@exportEmail")->name("exportarEmail");


		//Inicio

Route::get("settings","HomeController@settings")->name("settings");
Route::put("settings","HomeController@settingsUpdate")->name("settings.update");
//almacén

Route::post("select_product_warehouse","HomeController@add_warehouse")->name("select_product_warehouse");
Route::post("add_stock","HomeController@add_stock")->name("add_stock");
Route::post("test_code","HomeController@test_code")->name("test_code");
//Comprobar stock de producto
Route::post("test_stock","FacturasController@testStockFactura")->name("test_stock");
//Comprobar stock producto en facturas.edit
Route::post("test_stock_edit","FacturasController@test_stock_edit")->name("test_stock_edit");
Route::post("update_edit","FacturasController@update_edit")->name("update_edit");


Route::get("/loadProduct","ProductosController@loadProduct");
Route::post("addProduct","ProductosController@addProduct")->name("addProduct");
//editar productos de la factura (Detalle_factura)
//anulado
//Route::get("/editProduct","ProductosController@editProduct")->name("editProduct");
//almacenar la factura después de un cambio en un select
Route::get("storeResult","FacturasController@storeResult")->name("storeResult");
//eliminar producto de una factura
Route::post("prod_factura","FacturasController@destroyProdFactura")->name("destroyProdFactura");
//anulado
//Route::post("reload_factura","FacturasController@reloadFactura")->name("reloadFactura");
//Route::resource("supervisores","SupervisoresController");


//eliminar registros 
Route::post("deleteData","HomeController@deleteData")->name("deleteData");


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Routes

Route::middleware(["auth"])->group(function(){

	Route::get("warehouse","HomeController@warehouse")->name("warehouse")//;
	->middleware("permission:productos.edit");
	//Users

	Route::get("users","UserController@index")->name("users.index")
			->middleware("permission:users.index");
	Route::get("users/{user}","UserController@show")->name("users.show")
			->middleware("permission:users.show");			
	Route::get("users/edit/{user}","UserController@edit")->name("users.edit")
			->middleware("permission:users.edit");
	Route::put("users/update/{user}","UserController@update")->name("users.update")
			->middleware("permission:users.edit");
	
	Route::post("users_destroy","UserController@destroy")->name("users.destroy")
			->middleware("permission:users.destroy");

	//Roles

	Route::get("roles","RoleController@index")->name("roles.index")
			->middleware("permission:roles.index");
	Route::get("roles/create","RoleController@create")->name("roles.create")
			->middleware("permission:roles.create");
	Route::post("roles","RoleController@store")->name("roles.store")
			->middleware("permission:roles.store");
	Route::get("roles/{role}","RoleController@show")->name("roles.show")
			->middleware("permission:roles.show");
	Route::get("roles/edit/{role}","RoleController@edit")->name("roles.edit")
			->middleware("permission:roles.edit");
	Route::put("roles/{role}","RoleController@update")->name("roles.update")
			->middleware("permission:roles.edit");
	//roles destroy es el único sin petición ajax
	Route::delete("roles/{role}","RoleController@destroy")->name("roles.destroy")
			->middleware("permission:roles.destroy");


		//Vendedores	
	Route::get("vendedores","VendedoresController@index")->name("vendedores.index")
			->middleware("permission:vendedores.index");
	Route::get("vendedores/create","VendedoresController@create")->name("vendedores.create")
			->middleware("permission:vendedores.create");
	Route::post("vendedores","VendedoresController@store")->name("vendedores.store")
			->middleware("permission:vendedores.create");
	Route::get("vendedores/{vendedor}","VendedoresController@show")	//->where("vendedor","[0-9]+")
	->name("vendedores.show")
			->middleware("permission:vendedores.show");
	Route::get("vendedores/edit/{vendedor}","VendedoresController@edit")->name("vendedores.edit")
			->middleware("permission:vendedores.edit");

	Route::put("vendedores/{vendedor}","VendedoresController@update")->name("vendedores.update")
			->middleware("permission:vendedores.edit");
	
	Route::post("vendedores_destroy","VendedoresController@destroy")->name("vendedores.destroy")
			->middleware("permission:vendedores.destroy");

	//Supervisores	
	Route::get("supervisores","SupervisoresController@index")->name("supervisores.index")
			->middleware("permission:supervisores.index");
	Route::get("supervisores/create","SupervisoresController@create")->name("supervisores.create")
			->middleware("permission:supervisores.create");
	Route::post("supervisores","SupervisoresController@store")->name("supervisores.store")
			->middleware("permission:supervisores.create");

	Route::get("supervisores/{supervisor}","SupervisoresController@show")	//->where("vendedor","[0-9]+")
	->name("supervisores.show")
			->middleware("permission:supervisores.show");

	Route::get("supervisores/edit/{supervisor}","SupervisoresController@edit")->name("supervisores.edit")
			->middleware("permission:supervisores.edit");

	Route::put("supervisores/{supervisor}","SupervisoresController@update")->name("supervisores.update")
		->middleware("permission:supervisores.edit");
	
	Route::post("supervisores_destroy","SupervisoresController@destroy")->name("supervisores.destroy")
			->middleware("permission:supervisores.destroy");

	//Clientes
	Route::get("clientes","ClienteController@index")->name("clientes.index")
		->middleware("permission:clientes.index");
	Route::get("clientes/create","ClienteController@create")->name("clientes.create")
		->middleware("permission:clientes.create");
	Route::post("clientes","ClienteController@store")->name("clientes.store")
		->middleware("permission:clientes.create");
	Route::get("clientes/{cliente}","ClienteController@show")->name("clientes.show")
		->middleware("permission:clientes.show");
	Route::get("clientes/edit/{cliente}","ClienteController@edit")->name("clientes.edit")
		->middleware("permission:clientes.edit");
	Route::put("clientes/{cliente}","ClienteController@update")->name("clientes.update")
		->middleware("permission:clientes.edit");
	
		//método delete con ajax
	Route::post("clientes_destroy","ClienteController@destroy")->name("clientes.destroy")
	->middleware("permission:clientes.destroy");
		
		//adjuntado con el permiso de clientes
	//Destinatarios
	Route::get("destinatarios","DestinatariosController@index")->name("destinatarios.index")
		->middleware("permission:clientes.index");
	Route::get("destinatarios/create","DestinatariosController@create")->name("destinatarios.create")
		->middleware("permission:clientes.create");
	Route::post("destinatarios","DestinatariosController@store")->name("destinatarios.store")
		->middleware("permission:clientes.create");
	Route::get("destinatarios/{destinatario}","DestinatariosController@show")->name("destinatarios.show")
		->middleware("permission:clientes.show");
	Route::get("destinatarios/edit/{destinatario}","DestinatariosController@edit")->name("destinatarios.edit")
		->middleware("permission:clientes.edit");
	Route::put("destinatarios/{destinatario}","DestinatariosController@update")->name("destinatarios.update")
		->middleware("permission:clientes.edit");
	
	Route::post("destinatarios_destroy","DestinatariosController@destroy")->name("destinatarios.destroy")
		->middleware("permission:clientes.destroy");

	//Productos
	Route::get("productos","ProductosController@index")->name("productos.index")
		->middleware("permission:productos.index");
	Route::get("productos/create","ProductosController@create")->name("productos.create")
		->middleware("permission:productos.create");
	Route::post("productos","ProductosController@store")->name("productos.store")
		->middleware("permission:productos.create");
	Route::get("productos/{producto}","ProductosController@show")->name("productos.show")
		->middleware("permission:productos.show");
	Route::get("productos/edit/{producto}","ProductosController@edit")->name("productos.edit")
		->middleware("permission:productos.edit");
	Route::put("productos/{producto}","ProductosController@update")->name("productos.update")
		->middleware("permission:productos.edit");
		//pasamos delete a POST para ajax
	Route::post("productos_destroy","ProductosController@destroy")->name("productos.destroy")
		->middleware("permission:productos.destroy");

	//Categorías
	Route::get("categories","CategoryController@index")->name("categories.index")
		->middleware("permission:categories.index");
	Route::get("categories/create","CategoryController@create")->name("categories.create")
		->middleware("permission:categories.create");
	Route::post("categories","CategoryController@store")->name("categories.store")
		->middleware("permission:categories.create");
	Route::get("categories/{category}","CategoryController@show")->name("categories.show")
		->middleware("permission:categories.show");
	Route::get("categories/edit/{category}","CategoryController@edit")->name("categories.edit")
		->middleware("permission:categories.edit");
	Route::put("categories/{category}","CategoryController@update")->name("categories.update")
		->middleware("permission:categories.edit");
		
	Route::post("categories_destroy","CategoryController@destroy")->name("categories.destroy")
		->middleware("permission:categories.destroy");

	//Ventas
	Route::get("ventas","VentasController@index")->name("ventas.index")
		->middleware("permission:ventas.index");
	Route::get("ventas/create","VentasController@create")->name("ventas.create")
		->middleware("permission:ventas.create");
	Route::post("ventas","VentasController@store")->name("ventas.store")
		->middleware("permission:ventas.create");
	Route::get("ventas/{venta}","VentasController@show")->name("ventas.show")
		->middleware("permission:ventas.show");
	Route::get("ventas/edit/{venta}","VentasController@edit")->name("ventas.edit")
		->middleware("permission:ventas.edit");
	Route::put("ventas/{venta}","VentasController@update")->name("ventas.update")
		->middleware("permission:ventas.edit");
	
	Route::post("ventas_destroy","VentasController@destroy")->name("ventas.destroy")
		->middleware("permission:ventas.destroy");	
		
	//Facturas
	Route::get("facturas","FacturasController@index")->name("facturas.index")
		->middleware("permission:ventas.index");
	Route::get("facturas/create","FacturasController@create")->name("facturas.create")
		->middleware("permission:ventas.create");
	Route::post("facturas","FacturasController@store")->name("facturas.store")
		->middleware("permission:ventas.create");
	Route::get("facturas/{factura}","FacturasController@show")->name("facturas.show")
		->middleware("permission:ventas.show");
	Route::get("facturas/edit/{factura}","FacturasController@edit")->name("facturas.edit")
		->middleware("permission:ventas.edit");
	Route::put("facturas/{factura}","FacturasController@update")->name("facturas.update")
		->middleware("permission:ventas.edit");
	
//cambiado a post con ajax
	Route::post("facturas_destroy","FacturasController@destroy")->name("facturas.destroy")->middleware("permission:ventas.destroy");

//anulado (solo javascript)
	//añadir a producto a factura mediante scanner
	//Route::post("test_code_create","FacturasController@test_code_create")->name("test_code_create")->middleware("permission:ventas.create");
});