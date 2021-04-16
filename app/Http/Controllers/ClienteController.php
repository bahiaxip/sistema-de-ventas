<?php

namespace App\Http\Controllers;
use App\Cliente;
use App\Destinatario;

use Illuminate\Http\Request;
use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use Illuminate\Support\Facades\Storage;
use App\Classes\Paises;
//convertir array en objeto Laravel
use Illuminate\Support\Collection as Collection;
use App\Http\Controllers\HomeController as home;

class ClienteController extends Controller
{ 
    protected $paises;
    protected $pais;
    protected $provincias;

    public function __construct(){
        
        $this->paises=new Paises();
        $pais=$this->paises->all;
        //al ser solo dos métodos es posible en lugar de instanciarlos 
        //en el construct hacerlo desde cada método    
        //combinamos el array para el select country
        $this->pais=array_combine($pais,$pais);
        $provincias=$this->paises->provincias;
        //combinamos el array para el select province
        $this->provincias=array_combine($provincias,$provincias);
    }
    
    public function index()
    {
       $clientes=Cliente::paginate(10);       
       return view("clientes.index",compact("clientes"));
    }
    
    public function create()
    {   
        //obtenemos una colección de tipo laravel
        $paises=Collection::make($this->pais);
        $provincias=$this->provincias;
        return view("clientes.create",compact("paises","provincias"));        
    }

    public function store(ClienteStoreRequest $request)
    {        
        $cliente=Cliente::create($request->all());
        if($request->file("logo")){
            //si no existe (no debe existir) creamos directorio del 
            //cliente para el logo
            $dir="image/".$cliente->id;            
            //si no existe el directorio se crea
            if(!is_dir($dir))
                mkdir($dir);            
            $path=$request->file("logo")->store($dir);            
            $cliente->fill(["logo"=>$path])->save();            
        }
        //creamos tb un registro en destinatarios con los mismos datos 
        $destinatarios=Destinatario::create($request->only("name","surname","country","province","city","address","postal_code","email","phone","fax","cellphone"));
        return redirect()->route("clientes.index");
    }
    
    public function show(Cliente $cliente)
    {
        return view("clientes.show",compact("cliente"));
    }

    public function edit(Cliente $cliente)
    {
        $paises=Collection::make($this->pais);
        $provincias=$this->provincias;
        return view("clientes.edit",compact("cliente","paises","provincias"));
    }

    public function update(ClienteUpdateRequest $request, Cliente $cliente)
    {
        $cliente->update($request->all());

        if($request->file("logo")){
             //si no existe creamos directorio del cliente para el logo
            $dir="image/".$cliente->id;            
            //si no existe el directorio se crea
            if(!is_dir($dir))
                mkdir($dir);
            //escaneo del directorio
            $scan=@scandir($dir);
            //un directorio siempre tiene un array de 2 elementos
            //que son . y .. por tanto creamos la condición >2
            //de esta forma si al crear el cliente no se inserta ninguna 
            //imagen, al subirla en la edición no es necesario eliminar //nada, si existen eliminamos todo.
            if(count($scan)>2){
                $mask=$dir."/*.*";
                //hacemos unlink a todos los elementos del directorio
                array_map("unlink",glob($mask));
            }
            $path=$request->file("logo")->store($dir);
            $cliente->logo=$path;
            $cliente->save();
        }
        return redirect()->route("clientes.edit",$cliente->id);  
    }

    public function destroy(Request $request)
    {
        if($request->ajax()){
            //método estático que obtiene el nombre del controlador y //añade el prefijo . y el sufijo _table para pasar el nombre //del div que recarga los datos
            $div=home::ruta();
            $cliente=Cliente::where("id",$request->id)->first();
            $cliente->delete();
            $clientes=Cliente::paginate(10);
            //withPath permite que al eliminar con ajax no cambie la paginación
            $clientes->withPath("");
            $dato=view("clientes.table_clientes",compact("clientes"))->render();
            return response()->json(["dato"=>$dato,"div"=>$div]);
        }
    }
}