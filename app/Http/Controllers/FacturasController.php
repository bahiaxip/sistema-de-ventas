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

class FacturasController extends Controller
{
    protected $t;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        //dd($total_venta);
        //implementar acordeón
        if($request->venta){
            $venta_id=$request->venta;
            $venta=Venta::where("id",$venta_id)->first();
            $facturas=Factura::where("venta_id",$venta_id)->paginate(10);
        }
        
        
        return view("facturas.index",compact("facturas","venta","total_venta"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //select de productos y categorías de productos
        //$productos=Producto::all()->pluck("name","id");
        $productos=Producto::all();
        //$productos->prepend("Seleccione producto");
        $categorias=Category::all()->pluck("name","id");
        $categorias->prepend("Seleccione categoría");
        //dd($productos);
        if($request->get("venta")){
            $venta_id=$request->get("venta");

        }
        
        return view("facturas.create",compact("venta_id","productos","categorias"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //$factura=new Factura($request->all());        
        //$total=$factura->total;
        //$iva=$factura->vat;
        //$neto=$total/((100+$iva)/100);
        //$factura->net=$neto;
        //$factura->save();        
        $factura=Factura::create($request->all());

            //$callb ES UN CALLBACK DE LA FUNCIÓN array_map (más abajo)
        //array_map (solo 1 parámetro) con $value
        $callb=function($value){
            return get_object_vars($value);
        };
        
        //array_map(2 parámetros) con $key,$value
        /*
        $callb=function($key,$value){
            //return $value;
            return get_object_vars($value);
        };
        */
        if($request->datos != null){
            //decodificamos array de objetos

            //$a=json_decode(json_encode($request->collection_products),true);
            $a=json_decode($request->datos);
            //dd($a);
            //$a trae un array de objetos
            //print_r($a);exit;


                //PARA CONVERTIR UN ARRAY DE OBJETOS A ARRAY DE ARRAYS
                //ES POSIBLE CON UN FOR O CON LA FUNCIÓN array_map()
                //PERO ES NECESARIO EN LOS 2 CASOS EL MÉTODO get_object_vars()
            //opción con for de conversión de array de objetos a array de arrays
                /*
                $main=[];
                for($i=0;$i<sizeof($a);$i++){
                    $main[$i]=get_object_vars($a[$i]);    
                }
                //print_r($main);exit;
                */
            //opción con array_map de conversión de array de objetos a array de arrays
                //EN ESTE CASO EL array_map() ES POSIBLE CON 1 Y CON 2 PARÁMETROS
            //callback($callb) con 2 parámetros $key,$value                
                //$res=array_map($callb,array_keys($a),$a);
                
            //callback($callb) solo con 1 parámetro $value
                $res=array_map($callb,(array) $a);

                //print_r($res);exit;
                //con foreach podemos pasar de un array de arrays a una sucesión de arrays, es decir, si realizamos un print_r($res):
//Array([0]=>Array([key]=>[value] [key]=>[value] ...) [1]=> Array([key]=>[value] [key]=>[value]..)
                //pero si lo pasamos por un foreach tal como viene las siguientes //líneas de debajo convertimos el array de arrays a una sucesión de //arrays, el resultado con foreach:
//Array([key]=>[value] [key]=>[value]...) Array([key]=>[value] [key]=>[value]...)
                /*
                foreach($res as $key=>$value){
                    print_r($value);
                }
                exit;
                */

                //también podemos obtener resultados directos pasando la propiedad
                //directamente:
                    //echo $res[0]["name"];exit;
                //o con foreach:
                    
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
        return redirect()->route("facturas.index","venta=".$request->venta_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //select de productos y categorías de productos
        $productos=Producto::all()->pluck("name","id");
        $productos->prepend("Seleccione producto");
        $categorias=Category::all()->pluck("name","id");
        $categorias->prepend("Seleccione categoría");
        if(!session()->has("suma"))
            session("suma");

        //dd($productos);
        //$array=new array("Seleccione categoría","0");
        //$productos=array_merge($array,$productos);
        
        //productos de factura
        //$productos_factura=DB::table("detalle_factura")->where("id_factura",$factura->id)->get();
        $productos_factura=Detalle_factura::where("id_factura",$factura->id)->get();
        //dd($productos_factura);
        return view("facturas.show",compact("factura","productos","categorias","productos_factura"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {           
        $productos=Producto::all();
        //$categorias=Category::all()->pluck("name","id");
        $add_productos=Producto::all()->pluck("name","id");
        $add_productos->prepend("Seleccione producto");
        $categorias=Category::all()->pluck("name","id");
        $categorias->prepend("Seleccione categoría");
        //mediante session("suma") obtenemos el neto, la suma de todos los productos
        //multiplicado por sus cantidades. en el ajax-edit-table se realiza la suma
        if(!session()->has("suma"))
            session("suma");
        //print_r(session("suma"));exit;
        //dd($productos);
        //dd($productos);
        //$productos=Detalle_factura::where("id_factura",$factura->id)->pluck("name","id");
        $productos_factura=Detalle_factura::where("id_factura",$factura->id)->orderBy("id","desc")->get();
        //dd($productos_factura);  
        return view("facturas.edit",compact("factura","productos_factura","productos","add_productos","categorias"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {   
        
        //revisar y rehacer el update
        if($request->datos){
            $datos=json_decode($request->datos);
            //print_r($datos);exit;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        $factura->delete();
        //actualizamos importe total de venta
        $total_venta=self::load_venta($factura->venta_id);
        $venta=Venta::where("id",$factura->venta_id)->first();        
        $venta->total=$total_venta;
        $venta->save();
        return back();
    }
    
    public function destroyProdFactura(Request $request){
        if($request->ajax()){
            $producto_id=$request->producto;
            $factura_id=$request->factura;
            $factura=Detalle_factura::where("id_factura",$factura_id)
                ->where("id_producto",$producto_id)->first();
            //almacenamos la cantidad en variable antes del método delete.
            //Si no se almacena en la variable antes, la colección $factura
            //ya contendría el elemento
            //$f=$factura->cantidad;
            $factura->delete();
            //return $f;
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

                //$dato=array_merge($dato,$products_factura[$i]->cantidad);
                
                //con array_merge se unen array1 y array2                 
                //$dato=array_merge($dato,$v);
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
    //reloadFactura resta el producto multiplicado por su cantidad del neto de la factura
    //sería más correcto realizar la suma del resto de productos en lugar de restar el producto
    //ya que el sistema de redondeo podría hacer variar el resultado
//anulada
    public function reloadFactura(Request $request){
        if($request->ajax()){
            $cantidad=$request->cantidad;
            $factura_id=$request->factura;
            $product_id=$request->producto;
            /*
                                    //obtenemos precio del producto
                                    $product=Producto::where("id",$product_id)->first();
                                    $price_product=$product->price;
                                    //obtenemos la factura del producto
                                    $factura=Factura::where("id",$factura_id)->first();

                                    //actualizamos el neto y el total de la factura
                                    //aplicamos resta
                                    $factura->net=$factura->net-$cantidad*$price_product;
                                    //aplicamos el iva y redondeamos resultado
                                    $factura->total=round($factura->net*((100+$factura->vat)/100));
                                    $factura->save();
                                    //devolvemos el precio para asinarselo a la vista            
                                    $dato=["net"=>$factura->net,"total"=>$factura->total];
                                    return response()->json($dato);
            */
            
            //probamos suma en lugar de resta
            $products_factura=Detalle_factura::where("id_factura",$factura_id)->get();

        //prueba de array_map sobre consulta laravel

            //$products_factura=Detalle_factura::where("id_factura",$factura_id)->get()->toArray();
            /*
            $call=function($item){
                //$cantidad=$item["cantidad"];
                //buscar en productos el precio y multimplicar por cantidad para saber el precio
                return $item;    
            };
            $datos=array_map($call,(array) $products_factura);
            */

            //método suma para obtener la suma de todos los elementos del array
            //con array_reduce
            $suma=function($result,$item){
                $result+=$item;
                return $result;
            };

            $dato=[];

            //en este caso prescindimos de array_map ya que para array_map es 
            //necesario convertir la colección Laravel a array con toArray();
            //y necesitamos alcanzar una relación de la tabla productos, por 
            //tanto, necesitamos una colección Laravel y utilizamos un bucle for
            for($i=0;$i<sizeof($products_factura);$i++){
                $p=$products_factura[$i]->productos->price;
                $c=$products_factura[$i]->cantidad;
                $total_product=$p*$c;

                //$dato=array_merge($dato,$products_factura[$i]->cantidad);
                
            //con array_merge se unen array1 y array2                 
                //$dato=array_merge($dato,$v);
            //con array_push se añade elemento a un array, no se puede igualar
                //a una variable
                array_push($dato,$total_product);
            }
            //con array_reduce sumamos todos los elementos del array
            $net=array_reduce($dato,$suma);
            $factura=Factura::where("id",$factura_id)->first();
            $factura->net=$net;

            $total=round($net*((100+$factura->vat)/100));
            $factura->total=$total;
            $factura->save();
            return response()->json(["net"=>$net,"total"=>$total]);
        }
    }

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
    //anulado
    /*
    public function storeResult(Request $request){
        if($request->ajax()){
            $req=$request->all();
            //quita un elemento del principio del array
            array_shift($req);
            $factura=Factura::where("id",$request->id)->first();
            $factura->update($req);
            print_r($request->all());
        }
    }
    */

    public function export($id){
        

    //crear collection
        //$collection=new Collection(["id"=>"2","nombre"=>"hola"]);
        //$collection=new Collection(["id"=>"2","nombre"=>"hola"]);
        //$var=["id"=>"2","nombre"=>"hola"];
        //con alias Collection
        //$collection=Collection::make($var);
        //con helper        
        //$collection=collect([1,2,3]);
        
        
        //pasamos la colección en el constructor o pasamos el $id y
        //creamos en el método view o collection la colección
        $productos_factura=Detalle_factura::where("id_factura",$id)->get();
        return Excel::download(new FacturasExport($productos_factura),"factura.xlsx");
    }

    public function exportPDF($id){
        $productos_factura=Detalle_factura::where("id_factura",$id)->get();
        $pdf = \PDF::loadView("facturas.ajax-product",compact("productos_factura"));
        return $pdf->download("factura.pdf");
    }

}
