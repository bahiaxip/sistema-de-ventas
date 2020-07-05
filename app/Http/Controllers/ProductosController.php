<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Category;
use App\Detalle_factura;
use App\Http\Controllers\FacturasController;
use App\Venta;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as home;
use App\Http\Requests\ProductoStoreRequest;
use App\Http\Requests\ProductoUpdateRequest;
class ProductosController extends Controller
{    
    public function index()
    {        
        $productos=Producto::paginate(10);
        return view("productos.index",compact("productos"));
    }
    
    public function create()
    {
        $category=Category::all()->pluck("name","id");
        return view("productos.create",compact("category"));
    }
    
    public function store(ProductoStoreRequest $request)
    {        

        $producto= new Producto($request->all());

        $category=$request->get("category_id");
        if(!is_numeric($category)){
            $newCategory = Category::firstOrCreate(["name"=>ucwords($category)]);
            $producto->category_id=$newCategory->id;
        }
        //dd($request->stock);
        //añadimos un código de barras aleatorio
        /*
        $num=self::generateBarcodeNumber();
        $producto->code=$num;
        */
        $producto->save();
        
        return redirect()->route("productos.index");
    }
    
    public function show(Producto $producto)
    {
        return view("productos.show",compact("producto"));
    }
    
    public function edit(Producto $producto)
    {
        $category=Category::all()->pluck("name","id");
        return view("productos.edit",compact("producto","category"));
    }
    
    public function update(ProductoUpdateRequest $request, Producto $producto)
    {
        //opcion para poder insertar una categoría nueva desde el select
        $producto=Producto::where("id",$producto->id)->first();
        $producto->name=$request->name;
        $producto->product_model=$request->product_model;
        $producto->brand=$request->brand;
        $producto->price=$request->price;
        $producto->description=$request->description;
        $producto->stock=$request->stock;
        $category=$request->category_id;
        if(!is_numeric($category)){
            $newCategory=Category::firstOrCreate(["name"=>ucwords($category)]);
            $producto->category_id=$newCategory->id;

        }else{             
            $producto->category_id=$request->category_id;
        }
        $producto->save();        
        return redirect()->route("productos.edit",$producto->id);
    }

    public function destroy(Request $request)
    {
        if($request->ajax()){
            //método estático que obtiene el nombre del controlador y //añade el prefijo . y el sufijo _table para pasar el nombre //del div que recarga los datos
            $div=home::ruta();
            $producto=Producto::where("id",$request->id)->first();
            $producto->delete();
            $productos=Producto::paginate(10);
            //withPath permite que al eliminar con ajax no cambie la paginación
            $productos->withPath("");
            $dato=view("productos.table_productos",compact("productos"))->render();
            return response()->json(["dato"=>$dato,"div"=>$div]);
        }
    }

    //método respuesta ajax de select filtrar productos por categoría (en factura)
    //este método sirve para el select de categorías y productos de almacen y de facturas-edit y facturas-create
    //asociando y actualizando la vista del facturas/select-ajax 
    public function loadProduct(Request $request){        
        if($request->ajax()){
            $product_id= $request->data;
            if($product_id==0){
                $total_productos=Producto::all();
            }else{                
                $productos=Producto::where("category_id",$product_id)->get();
            }            
            $dato=view("../facturas/select-ajax",compact("productos","total_productos"))->render();
            
            return response()->json(["datos"=>$dato]);            
        }
    }

    //método para añadir productos en facturas.edit mediante petición AJAX
    public function addProduct(Request $request){        
        
        //aunque existe validación añadimos condición en caso de pasar
        //un producto con cantidad 0            
        if($request->ajax() && $request->cantidad != 0){            
            $id_producto= $request->producto;
            $id_factura=$request->factura;
            $cantidad=$request->cantidad;
            //comprobamos si existe stock suficiente del producto
            //si no existe detenemos y enviamos mensaje, si existe
            //se descuenta la cantidad del stock del producto
            $producto=Producto::where("id",$id_producto)->first();

            //descontamos el stock si no se ha marcado el checkbox de no descontar
            if($request->checkBox=="false"){
                if($cantidad > $producto->stock){
                    return "!STOCK";
                }else{
                    $producto->update(["stock"=>$producto->stock-$cantidad]);
                }    
            }
            
            $detalle_factura=Detalle_factura::where("id_factura",$id_factura)->where("id_producto",$id_producto)->first();
            
            if(!$detalle_factura){
                $detalle_factura=new Detalle_factura();
                $detalle_factura->cantidad=0;
            }            
        
            //updateOrCreate: si coincide el datos o datos del primer array 
            //se actualiza y si no se crea uno nuevo
            Detalle_factura::updateOrCreate(["id_producto"=>$id_producto,"id_factura"=>$id_factura],[            
                "cantidad"=>$detalle_factura->cantidad+$cantidad,                
            ]);
            //obtenemos desde Detalle_factura todos los productos y sus 
            //cantidades de la factura.
            $productos_factura=Detalle_factura::where("id_factura",$id_factura)->orderBy("id","desc")->get();            
            //enviamos los productos para el select
            $productos=Producto::all();
            $dato=view("../facturas/ajax-edit-table",compact("productos_factura","productos"))->render();

            //mediante session obtenemos la suma de todos los 
            //productos, actualizamos la tabla ventas y la pasamos para cambiarla en el facturas/show
            $suma=session()->get("suma");
            //obtenemos el primer registro de Detalle_factura para actualizar
            //la factura desde el método factura de su modelo
            $factura=Detalle_factura::where("id_factura",$id_factura)->first();
            //actualizamos la factura en la tabla facturas
            $factura->factura->net=$suma;
            $factura->factura->total=round($suma*((100+$factura->factura->vat)/100));
            $factura->factura->save();
            //actualizamos venta  importe total de venta
            $controler=new FacturasController();            
            $total_venta=$controler->load_venta($factura->factura->venta_id);
            $venta=Venta::where("id",$factura->factura->venta_id)->first();        
            $venta->total=$total_venta;
            $venta->save();
            return response()->json(array("dato"=>$dato,"suma"=>$suma));
        }else{            
            return "Error con la petición AJAX";
        }
    }

//bloque para código de barras
    //métodos para generar un número aleatorio que no se repita revisando en la db
    //si existe ya ese número
    public function generateBarcodeNumber(){
        $number= mt_rand(1000000000,9999999999);
        if(self::barcodeNumberExists($number)){
            return generateBarcodeNumber();
        }
        return $number;
    }

    public function barcodeNumberExists($number){
        //es posible comprobar si existe el número en el campo code con el método exists
        return Producto::wherecode($number)->exists();
    }
}