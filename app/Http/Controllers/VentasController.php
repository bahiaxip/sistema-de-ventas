<?php

namespace App\Http\Controllers;
use App\Venta;
use App\Cliente;
use App\Vendedor;
use App\Factura;
use App\Destinatario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {   
        
     
     
        if(!session()->has("design"))
            session("design");        
        session()->put("design","true");
        $design=session("design");
        
        $ventas=Venta::orderBy("id","desc")->paginate(10);
        //$clientes=Cliente::all();
        
        $vendedores=Vendedor::all();
        return view("ventas.index",compact("ventas","vendedores","design"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$now=Carbon::now();
        //dd($now->format("d-m-Y"));
        //dd($now->format("h:m:s"));
        //dd($now->format("l jS \\of F Y h:i:s A"));

        $clientes=Cliente::all("surname","name","id");
        $destinatarios=Destinatario::all("surname","name","id");
        $vendedores=Vendedor::all("surname","name","id");


        return view("ventas.create",compact("clientes","vendedores","destinatarios"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $now=Carbon::now();
        //dd($now);
        $venta=new Venta($request->all());
        //los campo date y time que devuelve el método now() //recogen de todo el string los datos que requieren
        //sin tener que recurrir al método format()
        //$venta->date=$now->format("Y-m-d");
        //$venta->time=$now->format("h:m:s");
        $venta->date=$now;
        $venta->time=$now;
        $venta->save();        
        
        return redirect()->route("ventas.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {        
        $facturas=Factura::where("venta_id","$venta->id")->get();
        return view("ventas.show",compact("venta","facturas"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        $clientes=Cliente::all("surname","name","id");
        $destinatarios=Destinatario::all("surname","name","id");
        $vendedores = Vendedor::all("surname","name","id");
        return view("ventas.edit",compact("venta","clientes","vendedores","destinatarios"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        $venta->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        $venta->delete();
        return back();
    }
}
