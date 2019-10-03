<?php

namespace App\Http\Controllers;

use App\Vendedor;
use App\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VendedorStoreRequest;
use App\Http\Requests\VendedorUpdateRequest;


class VendedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $supervisor=Supervisor::all();
        if($request->get("value")){
            
            $val=$request->get("value");
            $vendedor=Vendedor::where("id_supervisor",$val)->paginate(10);
            
            //$vendedor=DB::table("vendedores")->where("id_supervisor",$val)->get();
        }else{
            $vendedor=DB::table("vendedores")->paginate(10);
            $val=null;
        }
        return view("vendedores.index",compact("vendedor","supervisor","val"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //pasamos supervisor para mostrar la lista de supervisores
        $supervisor=Supervisor::all();
        return view("vendedores.create",compact("supervisor"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendedorStoreRequest $request)
    {   

        $vendedor=Vendedor::create($request->all());
        //dd($vendedor->id_supervisor);
        //return redirect()->route("vendedores.index");
        return redirect()->route("vendedores.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vendedor $vendedor)
    {
        return view("vendedores.show",compact("vendedor"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendedor $vendedor)
    {

        $supervisor=Supervisor::all();
        return view("vendedores.edit",compact("vendedor","supervisor"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendedorUpdateRequest $request, Vendedor $vendedor)
    {
        //dd("sdfsdfa");
        $vendedor->update($request->all());
        return redirect()->route("vendedores.edit",$vendedor->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendedor $vendedor)
    {
        $vendedor->delete();
        return back();
    }
}
