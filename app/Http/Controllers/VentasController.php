<?php

namespace App\Http\Controllers;
use App\Venta;
use App\Cliente;
use App\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas=Venta::paginate(10);
        //$clientes=Cliente::all();
        $vendedores=Vendedor::all();
        return view("ventas.index",compact("ventas","vendedores"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //$clientes=Cliente::pluck("name","surname","id");
        $clientes=Cliente::all("surname","name","id");
        $facturas=DB::table("facturas")->get();
        $vendedores=Vendedor::all("surname","name","id");


        return view("ventas.create",compact("clientes","vendedores","facturas"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        return view("ventas.show",compact("venta"));
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
        $facturas=DB::table("facturas")->get();
        $vendedores = Vendedor::all("surname","name","id");
        return view("ventas.edit",compact("venta","clientes","vendedores","facturas"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
