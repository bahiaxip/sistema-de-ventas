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
                $productos=0;
            }else{
                $productos=Producto::where("category_id",$product_id)->pluck("name","id")->all(); //necesario el all() si no $productos no está vacío
            }
            
            $dato=view("../facturas/select-ajax",compact("productos"))->render();
            return response()->json(["datos"=>$dato]);            
        }
    }

    public function addProduct(Request $request){
        if($request->all()){
            //return $request->all();
        }
        if($request->ajax()){            
            $id_producto= $request->producto;
            $id_factura=$request->factura;
            Detalle_factura::create([
                "id_producto"=>$id_producto,
                "cantidad"=>"1",
                "id_factura"=>$id_factura
            ]);
            $productos_factura=Detalle_factura::where("id_factura",$id_factura)->get();
            //$dato=view("../facturas/ajax-product",compact("productos_factura"))->render();
            $dato=view("../facturas/ajax-product",compact("productos_factura"))->render();
            return response()->json($dato);
            

        }
    }
}
