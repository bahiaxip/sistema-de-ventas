<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Category;
use App\Detalle_factura;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos=Producto::paginate(10);
        return view("productos.index",compact("productos"));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::all()->pluck("name","id");
        return view("productos.create",compact("category"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Al añadir al campo category_id un select que puede
        //crear categorías al no ser numérico da error
        //por tanto este método no es posible
        //$producto=Producto::create($request->all());

        $producto= new Producto($request->all());
        
        $category=$request->get("category_id");
        if(!is_numeric($category)){
            $newCategory = Category::firstOrCreate(["name"=>ucwords($category)]);
            $producto->category_id=$newCategory->id;
        }
        $producto->save();
        return redirect()->route("productos.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return view("productos.show",compact("producto"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $category=Category::all()->pluck("name","id");
        return view("productos.edit",compact("producto","category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //opcion para poder insertar una categoría nueva desde el select
        $producto=Producto::where("id",$producto->id)->first();

        $producto->name=$request->name;
        //dd($producto->product_model);       
        $producto->product_model=$request->product_model;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return back();
    }

    //método respuesta ajax de select filtrar productos por categoría
    public function loadProduct(Request $request){

        //return $request->all();
        if($request->ajax()){
            $product_id= $request->data;
            if($product_id==0){
                $total_productos=Producto::all();
            }else{
                //$productos=Producto::where("category_id",$product_id)->pluck("name","id")->all(); //necesario el all() si no $productos no está vacío
                $productos=Producto::where("category_id",$product_id)->get();
                
                
            }
            
            $dato=view("../facturas/select-ajax",compact("productos","total_productos"))->render();
            return response()->json(["datos"=>$dato]);            
        }
    }

    public function addProduct(Request $request){
        
        if($request->all()){
            //return $request->all();return;
        }
        if($request->ajax()){            
            $id_producto= $request->producto;
            $id_factura=$request->factura;
            $cantidad=$request->cantidad;
            //aunque existe validación añadimos condición en caso de pasar
            //un producto con cantidad 0
            if($cantidad==0){
                
            }
            else{
                $detalle_factura=Detalle_factura::where("id_factura",$id_factura)->where("id_producto",$id_producto)->first();
            //opción con updateOrCreate

            //condición para crear la propiedad cantidad, necesaria 
            //en caso de que la consulta $detalle_factura no devuelva //nada, es decir, que no haya registros de ese producto
            // en esta factura. Como el método updateOrCreate necesita
            //el mismo array para crear uno nuevo y para actualizar y, para 
            //actualizar la cantidad es necesario sumar la cantidad anterior
            //(si la hubiese), mantenemos la misma suma tb para la creación //creando un objeto Detalle_factura y asignando a la propiedad //cantidad el valor 0.
            if(!$detalle_factura){
                $detalle_factura=new Detalle_factura();
                $detalle_factura->cantidad=0;

            }            
            
            //updateOrCreate: si coincide el datos o datos del primer array //se actualiza y si no se crea uno nuevo
            Detalle_factura::updateOrCreate(["id_producto"=>$id_producto,"id_factura"=>$id_factura],[
                //"id_producto"=>$id_producto,
                "cantidad"=>$detalle_factura->cantidad+$cantidad,
                //"id_factura"=>$id_factura
            ]);
            

            //opción sin updateOrCreate

            //si ya existe ese producto en la factura acutalizamos si no creamos
            /*if($detalle_factura){                
                $detalle_factura->cantidad=$detalle_factura->cantidad+$cantidad;
                $detalle_factura->save();
            }else{                
                Detalle_factura::create([
                    "id_producto"=>$id_producto,
                    "cantidad"=>$cantidad,
                    "id_factura"=>$id_factura
                ]);    
            }*/


            }
            //obtenemos desde Detalle_factura todos los productos y su //cantidad de la factura
            $productos_factura=Detalle_factura::where("id_factura",$id_factura)->orderBy("id","desc")->get();
            //print_r($productos_factura[3]->cantidad);exit;
            $productos=Producto::all();
            //print_r($productos_factura);exit;
            
            //$dato=view("../facturas/ajax-product",compact("productos_factura"))->render();
            //$dato=view("../facturas/ajax-product",compact("productos_factura"))->render();
            $dato=view("../facturas/ajax-edit-table",compact("productos_factura","productos"))->render();

            //mediante session obtenemos la suma de todos los //productos, actualizamos la tabla ventas y la pasamos para cambiarla en el facturas/show
            $suma=session()->get("suma");

            
            //obtenemos el primer registro de Detalle_factura para actualizar
            //la factura desde el método factura de su modelo
            $factura=Detalle_factura::where("id_factura",$id_factura)->first();
            //print_r($suma);exit;
            //actualizamos la factura en la tabla facturas
            
            $factura->factura->net=$suma;
            $factura->factura->total=round($suma*((100+$factura->factura->vat)/100));
            
            $factura->factura->save();
            return response()->json(array("dato"=>$dato,"suma"=>$suma));
            

        }else{
            return "Error con la petición AJAX";
        }
    }

    
    public function editProduct(Request $request){
        if($request->ajax()){

            $factura_id=$request->factura;
            $producto_id=$request->producto;
            $nuevo_producto_id=$request->nuevoProducto;
            //seleccionamos el registro de Detall_factura y actualizamos

            $p_factura=Detalle_factura::where("id_factura",$factura_id)
                    ->where("id_producto",$producto_id)->first();
            $p_factura->id_producto=$nuevo_producto_id;
            $p_factura->cantidad=1;
            $p_factura->save();
            //$factura=Factura::where("id",$factura->id);


            $productos=Producto::all();
            $productos_factura=Detalle_factura::where("id_factura",$factura_id)->orderBy("id","desc")->get();

            $dato=view("../facturas.ajax-edit",compact("productos","productos_factura"))->render();
            return response()->json($dato);
            //return $request->data;
        }        
    }
    
        
}
