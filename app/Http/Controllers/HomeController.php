<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SettingsUpdateRequest;
use App\Category;
use App\Producto;
class HomeController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');        
    }
 
    public function index()
    {        
        return view('home');
    }    
    
    public static function ruta(){     
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

    public function settings(){
        $design_index=DB::table("data")->where("name","DESIGN_INDEX")->first();
        $vat=DB::table("data")->where("name","IVA")->first();
        return view("settings",compact("design_index","vat"));
    }

    public function settingsUpdate(SettingsUpdateRequest $request){

        if(isset($request->design_index)){
            $design=$request->design_index;
            $design_query=DB::table("data")->where("name","DESIGN_INDEX")->update(["data"=>$design]);
        }
        if(isset($request->vat)){                
            if($request->vat!=0){
            $vat=$request->vat;
            $vat=DB::table("data")->where("name","IVA")->update(["data"=>$vat]);
            }
        }
        return redirect()->route("settings");
    }

    public function warehouse(){
        
        $categorias=Category::all()->pluck("name","id");
        $categorias->prepend("Seleccione categoría");
        $productos=Producto::all()->pluck("name","id");
        $productos->prepend("Seleccione producto");
        return view("warehouse",compact("categorias","productos"));
    }

    public function add_warehouse(Request $request){        
        if($request->ajax()){            
            $id=$request->id;
            $producto=$request->producto;
            $producto=Producto::where("id",$id)->first();            
            $html=
            '<div class="col-12 ">
                    <h4 class="text-center fondo-gris pt-2 pb-2">'.$producto->name.'</h4>
                <table class="table table-hover bg-white" >
                    <tbody>
                        <tr>
                            <td><button class="btn btn-orange text-white">Stock</button></td>
                            <td id="stock">'.$producto->stock.'</td>
                            <input type="hidden" value="'.$producto->id.'" id="product_id">
                        </tr>
                        <tr>
                            <td><button class="btn btn-orange text-white">Cantidad</button></td>
                            <td><input style="width:50px" type="number" value="1" id="amount"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class=""><button class="btn btn-black text-white" onclick="addWarehouse(this,event)">Añadir</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            ';
        return $html;            
        }else{
            return "No existe $reqeustajax";
        }
    }

    public function add_stock(Request $request){
        if($request->ajax()){
            $id=$request->id;
            $amount=$request->amount;
            $producto=Producto::where("id",$id)->first();
            
            $stock=$producto->stock+$amount;
            $producto->stock=$stock;
            $producto->save();
            return $producto->stock;
        }
    }
    
    public function test_code(Request $request){        
        if($request->ajax()){
            if($request->code){
                $producto=Producto::where("code",$request->code)->first();
                if($producto!=null){
                    $html=
                        '<div class="col-12 ">
                                <h4 class="text-center fondo-gris pt-2 pb-2">'.$producto->name.'</h4>
                            <table class="table table-hover bg-white" >
                                <tbody>
                                    <tr>
                                        <td><button class="btn btn-orange text-white">Stock</button></td>
                                        <td id="stock">'.$producto->stock.'</td>
                                        <input type="hidden" value="'.$producto->id.'" id="product_id">
                                    </tr>
                                    <tr>
                                        <td><button class="btn btn-orange text-white">Cantidad</button></td>
                                        <td><input style="width:50px" type="number" value="1" id="amount"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class=""><button class="btn btn-black text-white" onclick="addWarehouse(this,event)">Añadir</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        ';
                    return $html;

                }else{
                    return "false";

                }
            }
        }
    }
}
