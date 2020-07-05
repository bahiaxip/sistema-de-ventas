<?php

namespace App\Http\Controllers;

use App\Vendedor;
use App\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VendedorStoreRequest;
use App\Http\Requests\VendedorUpdateRequest;
use App\Http\Controllers\HomeController as home;

class VendedoresController extends Controller
{    
    public function index(Request $request)
    {
        $supervisor=Supervisor::all();
        if($request->get("value")){
            
            $val=$request->get("value");
            $vendedor=Vendedor::where("id_supervisor",$val)->paginate(10);
        }else{
            $vendedor=DB::table("vendedores")->paginate(10);
            $val=null;
        }
        return view("vendedores.index",compact("vendedor","supervisor","val"));
    }
    
    public function create()
    {
        //pasamos supervisor para mostrar la lista de supervisores
        $supervisor=Supervisor::all();
        return view("vendedores.create",compact("supervisor"));
    }
    
    public function store(VendedorStoreRequest $request)
    {   
        $vendedor=Vendedor::create($request->all());
        return redirect()->route("vendedores.index");
    }
    
    public function show(Vendedor $vendedor)
    {
        return view("vendedores.show",compact("vendedor"));
    }
    
    public function edit(Vendedor $vendedor)
    {
        $supervisor=Supervisor::all();
        return view("vendedores.edit",compact("vendedor","supervisor"));
    }
    
    public function update(VendedorUpdateRequest $request, Vendedor $vendedor)
    {
        $vendedor->update($request->all());
        return redirect()->route("vendedores.edit",$vendedor->id);
    }

    public function destroy(Request $request){
        if($request->ajax()){
            $div=home::ruta();

            $vended=Vendedor::where("id",$request->id)->first();
            $vended->delete();
            $vendedor=Vendedor::paginate(10);
            //withPath permite que al eliminar con ajax no cambie la paginación
            $vendedor->withPath("");
            $dato=view("vendedores.table_vendedores",compact("vendedor"))->render();
            return response()->json(["dato"=>$dato,"div"=>$div]);
        }
    }
}