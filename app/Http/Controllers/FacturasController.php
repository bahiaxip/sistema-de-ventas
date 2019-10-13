<?php

namespace App\Http\Controllers;

use App\Factura;
use App\Producto;
use App\Category;
use App\Detalle_factura;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //implementar acordeón
        if($request->venta){
            $venta_id=$request->venta;
            $facturas=Factura::where("venta_id",$venta_id)->paginate(10);
        }else{
            $facturas=Factura::paginate(10);
        }
        
        return view("facturas.index",compact("facturas","venta_id"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->get("venta")){
            $venta_id=$request->get("venta");

        }
        return view("facturas.create",compact("venta_id"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $factura=new Factura($request->all());
        $total=$factura->total;
        $iva=$factura->vat;
        $neto=$total/((100+$iva)/100);
        $factura->net=$neto;
        //dd($neto);
        //dd($request->all());
        //$factura=Factura::create($request->all());
        $factura->save();
        //dd($factura);
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
        $categorias=Category::all()->pluck("name","id");
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
        return view("facturas.edit",compact("factura"));
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
        $factura=Factura::where("id",$factura->id)->first();
        $factura->vat=$request->vat;
        $factura->total=$request->total;
        $neto=$factura->total/((100+$factura->vat)/100);
        $factura->net=$neto;
        $factura->state=$request->state;
        $factura->order_buy=$request->order_buy;
        $factura->office_guide=$request->office_guide;
        $factura->save();
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
        return back();
    }
}
