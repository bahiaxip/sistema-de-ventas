<?php

namespace App\Http\Controllers;
use App\Destinatario;
use Illuminate\Http\Request;
use App\Classes\Paises;
use App\Http\Controllers\HomeController as home;
use App\Http\Requests\DestinatarioStoreRequest;
use App\Http\Requests\DestinatarioUpdateRequest;
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
    
    public function store(DestinatarioStoreRequest $request)
    {
        Destinatario::create($request->all());
        return redirect()->route("destinatarios.index");
    }
    
    public function show(Destinatario $destinatario)
    {
        return view("destinatarios.show",compact("destinatario"));
    }
    
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
    
    public function update(DestinatarioUpdateRequest $request, Destinatario $destinatario)
    {       
        $destinatario->update($request->all());
        return redirect()->route("destinatarios.edit",$destinatario->id);
    }

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