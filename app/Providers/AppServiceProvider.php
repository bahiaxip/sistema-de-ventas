<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //se recomienda crear un provider y llamarlo en lugar de crearlo aquí
        //php artisan make:provider archivoServiceProvider
        //añadimos en el array providers de config/app.php
        //es posible con el helper view o con el Facade importándolo
        //https://styde.net/uso-de-view-composer-laravel-5/

        //un "*" indica todas las vistas
        view()->composer("*.index",function($view){
            //podemos hacer que la variable user en las vistas indicadas //siempre sea la colección del user logueado, si en la vista
            //existiese otra variable user asignada en el controlador, éste //user machaca al del controlador
            //$view->with("user",Auth::user());


            //si existe usuario logueado asignamos a config/datos.design
            //el valor de la db en la tabla profiles
            if(Auth::user()){
                $val=DB::table("profiles")->where("user_id",Auth::user()->id)->first();
                Config::set("datos.design",$val->design_index);    
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
