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

Route::get('/', function () {
    return view('index');
});

//Route::get("vendedores","VendedoresController@show")->name("vendedores");

Route::get("/loadProduct","ProductosController@loadProduct");

//Route::resource("supervisores","SupervisoresController");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Routes

Route::middleware(["auth"])->group(function(){
	//Users

	Route::get("users","UserController@index")->name("users.index")
			->middleware("permission:users.index");
	Route::get("users/{user}","UserController@show")->name("users.show")
			->middleware("permission:users.show");
	Route::get("users/edit/{user}","UserController@edit")->name("users.edit")
			->middleware("permission:users.edit");
	Route::put("users/update/{user}","UserController@update")->name("users.update")
			->middleware("permission:users.edit");
	Route::delete("user/destroy/{user}","UserController@destroy")->name("users.destroy")
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
			
	Route::delete("vendedores/{vendedor}","VendedoresController@destroy")->name("vendedores.destroy");

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
			
	Route::delete("supervisores/{supervisor}","SupervisoresController@destroy")->name("supervisores.destroy");
			
	Route::resource("clientes","ClienteController");
	Route::resource("destinatarios","DestinatariosController");
	Route::resource("productos","ProductosController");
	Route::resource("categories","CategoryController");
/*<<<<<<< Updated upstream*/
	Route::resource("ventas","VentasController");
	Route::resource("facturas","FacturasController");
/*=======
>>>>>>> Stashed changes*/
	
	//Vendedores necesario auth
	//Route::resource("vendedores","VendedoresController");
	//Supervisores necesario auth
	//Route::resource("supervisores","SupervisoresController");
});
