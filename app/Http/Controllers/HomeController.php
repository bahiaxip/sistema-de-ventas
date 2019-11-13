<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    public function getIndex(Route $route){
        
        echo "getIndex";
        echo $route->getActionName();        
    }
    */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('home');
    }
    /*
    public function deleteData(Request $request){
        if($request->ajax()){
            $a=Route::getCurrentRoute()->getActionName();
            $b=explode("@",Route::getCurrentRoute()->getActionName())[0];
            $c=explode("\\",$b)[3];
            $d=explode("Controller",$c)[0];
            //$c=$b."@destroy";
            $d=strtolower($d);

            print_r($d.".destroy");
            redirect()->route('$d',)

            //print_r($request->all());
            //$id=$request->id;
            
        }
    }
*/
    //método estático que obtiene el nombre del controlador, lo pasa a 
    //minúsculas y le añade el sufijo .destroy
    //anulado
    
    public static function ruta(){
        //ruta del controlador con su método
        //$ruta=Route::getCurrentRoute()->getActionName();
        //array de ruta del controlador
        $ruta=Route::getCurrentRoute()->getAction();
        //extraemos el nombre del controlador   
        $controlador=class_basename($ruta["controller"]);        
        //$b=explode("@",Route::getCurrentRoute()->getActionName())[0];
        //dividimos el nombre del controlador con su método en un array
        $arr_controlador=explode("@",$controlador);
        //extraemos el sufijo Controller 
        $result=explode("Controller",$arr_controlador[0])[0];        
        //pasamos a minúsculas
        $res=strtolower($result);
        return ".".$res."_table";
    }

    public function warehouse(){
        
        return view("warehouse");
    }
    
}
