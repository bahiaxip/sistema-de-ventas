<?php

namespace App\Http\Controllers;
use App\Destinatario;
use Illuminate\Http\Request;
use App\Classes\Paises;
use App\Http\Controllers\HomeController as home;
class DestinatariosController extends Controller
{
    
    protected $paises;
    protected $pais;
    protected $provincias;

    public function __construct(){
        $this->paises=new Paises();
    }

    public function index()
    {
        $destinatarios=Destinatario::paginate(10);
        return view("destinatarios.index",compact("destinatarios"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_paises=$this->paises->all;
        //combinamos el array para el select country
        $paises=array_combine($list_paises,$list_paises);
        $list_provincias=$this->paises->provincias;
        //combinamos el array para el select province
        $provincias=array_combine($list_provincias,$list_provincias);

        return view("destinatarios.create",compact("paises","provincias"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Destinatario::create($request->all());
        return redirect()->route("destinatarios.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Destinatario $destinatario)
    {

        return view("destinatarios.show",compact("destinatario"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Destinatario $destinatario)
    {
        //todos los países
        $pais=$this->paises->all;
        //combinamos el array para el select country
        $paises=array_combine($pais,$pais);
        //todas las provincias españolas
        $list_provincias=$this->paises->provincias;
        //combinamos el array para el select province
        $provincias=array_combine($list_provincias,$list_provincias);
        return view("destinatarios.edit",compact("paises","provincias","destinatario"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destinatario $destinatario)
    {
        /*
        if($destinatario->country=="España" && $request->country!="España"){
            $request->province=null;
        }
        */
        $destinatario->update($request->all());
        return redirect()->route("destinatarios.edit",$destinatario->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //modificado  a destroy con ajax
    /*
    public function destroy(Destinatario $destinatario)
    {
        $destinatario->delete();
        return back();
    }
    */

    public function destroy(Request $request){

        if($request->ajax()){            
            $div=home::ruta();
            $destinatario=Destinatario::where("id",$request->id)->first();
            $destinatario->delete();
            $destinatarios=Destinatario::paginate(10);
            //withPath permite que al eliminar con ajax no cambie la paginación
            $destinatarios->withPath("");
            $dato=view("destinatarios.table_destinatarios",compact("destinatarios"))->render();
            return response()->json(["dato"=>$dato,"div"=>$div]);

        }
    }

}   
