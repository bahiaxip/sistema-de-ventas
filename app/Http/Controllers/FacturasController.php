<?php

namespace App\Http\Controllers;

use App\Factura;
use App\Producto;
use App\Category;
use App\Detalle_factura;
use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\FacturasExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Mail;
use App\Mail\Factura as emailFactura;
use App\Http\Requests\FacturaStoreRequest;
use App\Http\Requests\FacturaUpdateRequest;
use App\Http\Controllers\HomeController as home;

class FacturasController extends Controller
{ 
    public function index(Request $request)
    {        
        //implementar acordeón
        if($request->venta){
            $venta_id=$request->venta;
            $venta=Venta::where("id",$venta_id)->first();
            $facturas=Factura::where("venta_id",$venta_id)->paginate(10);
        }        
        //return view("facturas.index",compact("facturas","venta","total_venta"));
        return view("facturas.index",compact("facturas","venta"));
    }
    
    public function create(Request $request)
    {    
        $vat=DB::table("data")->where("name","IVA")->first();     
        $productos=Producto::all();
        //$productos->prepend("Seleccione producto");
        $categorias=Category::all()->pluck("name","id");
        $categorias->prepend("Seleccione categoría");        
        if($request->get("venta")){
            $venta_id=$request->get("venta");
        }        
        return view("facturas.create",compact("venta_id","productos","categorias","vat"));
    }
    
    public function store(FacturaStoreRequest $request)
    {     
        $factura=Factura::create($request->all());
        //$callb ES UN CALLBACK DE LA FUNCIÓN array_map (más abajo)        
        $callb=function($value){
            return get_object_vars($value);
        };
        if($request->datos != null){
            //decodificamos array de objetos
            $a=json_decode($request->datos);            
            //callback($callb) solo con 1 parámetro $value
                $res=array_map($callb,(array) $a);
                //con foreach:                    
                foreach($res as $key=>$value){
                    $detalle_factura=new Detalle_factura();
                    $detalle_factura->id_producto=$value["id"];
                    $detalle_factura->cantidad=$value["amount"];
                    $detalle_factura->id_factura=$factura->id;
                    $detalle_factura->save();
                }
                //actualizamos importe total de venta
                $total_venta=self::load_venta($factura->venta_id);
                $venta=Venta::where("id",$factura->venta_id)->first();        
                $venta->total=$total_venta;
                $venta->save();
        }
        return redirect()->route("facturas.index","venta=".$request->venta_id)
            ->with("info","La factura se ha creado satisfactoriamente");
    }
    
    public function show(Factura $factura)
    {
        //select de productos y categorías de productos
        $productos=Producto::all()->pluck("name","id");
        $productos->prepend("Seleccione producto");
        $categorias=Category::all()->pluck("name","id");
        $categorias->prepend("Seleccione categoría");
        if(!session()->has("suma"))
            session("suma");        
        //productos de factura        
        $productos_factura=Detalle_factura::where("id_factura",$factura->id)->get();
        return view("facturas.show",compact("factura","productos","categorias","productos_factura"));
    }
    
    public function edit(Factura $factura)
    {
        $productos=Producto::all();
        $add_productos=Producto::all()->pluck("name","id");
        $add_productos->prepend("Seleccione producto");
        $categorias=Category::all()->pluck("name","id");
        $categorias->prepend("Seleccione categoría");
        //mediante session("suma") obtenemos el neto, la suma de todos los productos
        //multiplicado por sus cantidades. en el ajax-edit-table se realiza la suma
        if(!session()->has("suma"))
            session("suma");        
        $productos_factura=Detalle_factura::where("id_factura",$factura->id)->orderBy("id","desc")->get();        
        return view("facturas.edit",compact("factura","productos_factura","productos","add_productos","categorias"));
    }
    
    public function update(FacturaUpdateRequest $request, Factura $factura)
    {  
        //revisar y rehacer el update
        if($request->datos){
            $datos=json_decode($request->datos);
            //comprobar con array_map
            for($i=0;$i<sizeof($datos);$i++){
                $id=$datos[$i]->id;
                $detalle=Detalle_factura::where("id_factura",$factura->id)
                    ->where("id_producto",$id)->first();
                $detalle->id_producto=$datos[$i]->newId;
                $detalle->cantidad=$datos[$i]->amount;
                $detalle->save();
            }
        }
        //actualizar la cantidad de cada producto    
        $factura=Factura::where("id",$factura->id)->first();
        $factura->net=$request->net;
        $factura->vat=$request->vat;
        $factura->total=$request->total;
        //nos traemos ya el neto directamente 
        //$neto=$factura->total/((100+$factura->vat)/100);
        //$factura->net=$neto;        
        $factura->state=$request->state;
        $factura->order_buy=$request->order_buy;
        $factura->office_guide=$request->office_guide;
        $factura->save();
        //actualizamos importe total de venta
        $total_venta=self::load_venta($factura->venta_id);
        $venta=Venta::where("id",$factura->venta_id)->first();        
        $venta->total=$total_venta;
        $venta->save();       
        return back();
    }
    
    //al elminar la factura se vuelven a añadir los productos al stock
    public function destroy(Request $request){
        if($request->ajax()){
            $div=home::ruta();
            //obtenemos todos los productos de la factura
            //$det_factura=Detalle_factura::where("id_factura",$request->id)->get()->toArray();
            $det_factura=Detalle_factura::where("id_factura",$request->id)->get();
            //si no se ha marcado el checkbox(valor false) se descuenta el stock
            //de todos los productos de la factura
            if($request->checkBox=="false"){                
                $list=[];
                foreach($det_factura as $key=>$value){
                    $list[$key]=$value;
                }                
                collect($list)->map(function($list){
                    $producto=Producto::where("id",$list["id_producto"])->first();
                    $producto->update(["stock"=>$producto->stock+$list["cantidad"]]);
                });
            }
            //se elimina la factura

            $factura=Factura::where("id",$request->id)->first();
            $venta_id=$factura->venta_id;
            $venta=Venta::where("id",$venta_id)->first();
            
            $factura->delete();
            
            $facturas=Factura::where("venta_id",$venta_id)->paginate(10);
            //return $venta;

            $dato=view("facturas.table_facturas",compact("facturas","venta"))->render();

            return response()->json(["dato"=>$dato,"div"=>$div]);
        }
    }
    //Eliminar producto en edición de factura
    public function destroyProdFactura(Request $request){
        if($request->ajax()){
            $producto_id=$request->producto;
            $factura_id=$request->factura;
            $factura=Detalle_factura::where("id_factura",$factura_id)
                ->where("id_producto",$producto_id)->first();
            //almacenamos la cantidad en variable antes del método delete.
            $cantidad=$factura->cantidad;
            //si no se ha marcado el checkbox(false) reponemos el stock del producto
            if($request->checkBox=="false"){
                $producto=Producto::where("id",$producto_id)->first();
                $producto->update(["stock"=>$producto->stock + $cantidad]);    
            }
            
            //eliminamos el producto de la factura alojado en la tabla detalle_factura
            $factura->delete();            
            $products_factura=Detalle_factura::where("id_factura",$factura_id)->get();
            //callback de método reduce
            $suma=function($result,$item){
                $result+=$item;
                return $result;
            };
            //array para almacenar todos los totales de cada producto
            //el total equivale al precio del producto multiplicado por
            //la cantidad que contenga ese producto
            $dato=[];
            //extraemos el total(multiplicado por su cantidad) de cada producto
            //y lo añadimos a un array para después realizar la suma mediante el
            //método reduce y su callback $suma
            for($i=0;$i<sizeof($products_factura);$i++){
                $p=$products_factura[$i]->productos->price;
                $c=$products_factura[$i]->cantidad;
                $total_product=$p*$c;                
                //con array_push se añade elemento a un array, no se puede igualar
                //a una variable                
                array_push($dato,$total_product);
            }
            //con array_reduce sumamos todos los elementos del array
            $net=array_reduce($dato,$suma);
            $factura=Factura::where("id",$factura_id)->first();
            //actualizamos el neto y el total de la factura
            $factura->net=$net;
            $total=round($net*((100+$factura->vat)/100));
            $factura->total=$total;
            $factura->save();
            //actualizamos importe total de venta
            $total_venta=self::load_venta($factura->venta_id);
            $venta=Venta::where("id",$factura->venta_id)->first();        
            $venta->total=$total_venta;
            $venta->save();
            return response()->json(["net"=>$net,"total"=>$total]);
        }
    }
    
    //test_stock_edit comprueba si la cantidad nueva es mayor o menor a la que ya //existe y si es mayor se comprueba si existe suficiente y se descuenta, y si 
    //es menor se aumenta en la db.
    public function test_stock_edit(Request $request){
        if($request->ajax()){
            $producto=Producto::where("id",$request->id)->first();
            $cant_final=$request->cantidad_final;
            $cant_inicial = $request->cantidad_inicial;
            //si la cantidad final es mayor hay que comprobar el stock
            $cant_result=$cant_final-$cant_inicial;
            //return $cant_result;                            
            if($producto->stock >= $cant_result){
                $producto->update(["stock"=>$producto->stock-$cant_result]);
                return "true";
            }else{
                return "false";
            }
        }
    }
    //load_venta devuelve el total del importe neto de todas las facturas
    public function load_venta($venta_id){
        $facturas=Factura::where("venta_id",$venta_id)->get()->toArray();
        $call=function($item){
            return $item["net"];
        };
        $listTotal=array_map($call,(array) $facturas);
        $suma=function($a,$b){
            $a+=$b;
            return $a;
        };
        $result=array_reduce($listTotal,$suma);
        return $result;
    }    

    public function export($id){
        //pasamos la colección en el constructor o pasamos el $id y
        //creamos en el método view o collection la colección
        $productos_factura=Detalle_factura::where("id_factura",$id)->get();
        return Excel::download(new FacturasExport($productos_factura),"factura.xlsx");
    }

    public function exportPDF($id){
        $productos_factura=Detalle_factura::where("id_factura",$id)->get();
        //$pdf = \PDF::loadView("facturas.ajax-product",compact("productos_factura"))->setPaper("a3");
        $view="facturas.ajax-product";
        $html="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown.";
        $pdf= \PDF::loadView($view,compact("productos_factura"));
        //$pdf->setOptions(["defaultFont"=>"arial","dpi"=>"150"]);
        return $pdf->download("factura.pdf");
    }
    //necesario SendEmailRequest
    public function exportEmail(Request $request){
        if(isset($request)){
            //email de destino seleccionado
            $destino=$request->hiddenEmail;            
            $id_factura=$request->id_factura;
            //consulta de todos los productos de la factura
            $productos_factura=Detalle_factura::where("id_factura",$id_factura)->get();
            //Envío de factura por Mail
            Mail::to($destino)->send(new emailFactura($productos_factura,$destino));
        }
        return back();
    }
    //método de comprobación de stock del productos o productos, en caso afirmativo
    //se realiza el descuento del campo stock de cada producto
    public function testStockFactura(Request $request){
        //return "nada";
        $list=[];
        $list_name=[];       
        $switch="true";
        if($request->ajax()){
        //primero comprobar si alguno de los productos está falto de stock y después realizar el descuento de todos los productos
            foreach ($request->data as $key => $value) {
                //array_push($a,$value["id"]);
                $producto=Producto::where("id",$value["id"])->first();
                if($producto!=null){
                    if($producto->stock > $value["amount"]){
                        //si existe stock se mantiene el array para descontar el stock
                        $list[$key]= $value;                        
                    }else{
                        //si no existe suficiente stock se añaden en $switch los nombres de los productos sin stock
                        array_push($list_name,$producto->name);
                        $switch="false";
                    }
                }else{
                    //si no existe producto
                    $switch="error";
                    break;
                }
            }
            //devolvemos los datos de la petición ajax:
            //true: descontamos el stock de dichos productos y enviamos un mensaje, //después de el submit (añadido desde el método store).
            //false: enviamos un mensaje con los nombres de los productos que no //disponen de stock suficiente 
            //error: enviamos un mensaje de error
            switch ($switch){
                case "true":
                    //método map de Laravel (similar a array_map de PHP) para
                    //descontar la cantidad de stock de cada producto
                    $data=collect($list)->map(function ($list){
                        $producto=Producto::where("id",$list["id"])->first();
                        $producto->update(["stock"=>$producto->stock-$list["amount"]]);
                    });
                    $data["data"]="true";                    
                    break;
                case "false":
                    $data["name"]=$list_name;
                    $data["data"]="false";                    
                    break;
                case "error":
                    $data["data"]="error";
                    $data="error";
                    break;
            }            
            return $data;
        }        
    }
    //método update_edit actualiza la factura al aumentar o disminuir (desde el input number)
    //la cantidad de algún producto en la edición de la factura
    public function update_edit(Request $request){
        if($request->ajax()){
            if($request->id){
                //actualizamos la cantidad del producto en la factura en la tabla detalle_factura
                $detalle_factura=Detalle_factura::where("id_factura",$request->idFactura)->where("id_producto",$request->id)->first();
                $detalle_factura->update(["cantidad"=>$request->cantidad]);
                //actualizamos la factura
                $factura=Factura::where("id",$request->idFactura)->first();
                $factura->update(["net"=>$request->neto,"vat"=>$request->iva,"total"=>$request->totalSum,"state"=>$request->state,"order_buy"=>$request->orderBuy,"office_guide"=>$request->officeGuide]);
                //actualizar venta comprobar 
                $total_venta=self::load_venta($factura->venta_id);
                $venta=Venta::where("id",$factura->venta_id)->first();
                $venta->total=$total_venta;
                $venta->save();
            }            
            return "hecho";            
        }
    }

    public function test_code_create(Request $request){
        if($request->ajax()){
            return $request;
        }
    }
}