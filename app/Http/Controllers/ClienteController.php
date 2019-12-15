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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //obteniendo datos de archivo json
        //file_get_contents(filename)
        //json con paises de Europa pero en inglés
        //$json=file_get_contents(asset("paises/europe.json"));
        //json con países de habla hispana en inglés
        //$json2=file_get_contents(asset("paises/paises-es.json"));
        //$data=json_decode($json);

        //ordenar array alfabeticamente
        //sort($datos);
        
        //array_flip intercambia el valor y la clave de un array
        //$flip=array_flip($this->d);

        //array_pop elimina el último elemento de un array
        //array_pop($this->d);
        //array_combine crear un array donde el primer parámetro 
        //son las keys y el segundo los valores (deben tener el mismo 
        //número de elementos)
        
        
        //creamos una colección laravel con la clase Collection
        //$datos=Collection::make($datos);
        
        //convirtiendo array en objeto en php
        /*
        $obj=new \stdClass();
        foreach($datos as $key=>$value)
        {
            $obj->$key=$value;
        }
        */
        

       $clientes=Cliente::paginate(10);
       
       return view("clientes.index",compact("clientes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //obtenemos una colección de tipo laravel
        $paises=Collection::make($this->pais);
        $provincias=$this->provincias;
        return view("clientes.create",compact("paises","provincias"));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteStoreRequest $request)
    {        
        $cliente=Cliente::create($request->all());

        

        if($request->file("logo")){
            //si no existe (no debe existir) creamos directorio del //cliente para el logo
            $dir="image/".$cliente->id;            
            //si no existe el directorio se crea
            if(!is_dir($dir))
                mkdir($dir);

            //modificando el config/filesystem es necesario de las 2 formas siguientes tanto para la opción con el $path como para el save()
            //opcion1 para ruta($path)
            //$path = Storage::disk("public")->put("image/",$request->file("logo"));
            //opcion2 para ruta($path)            
            $path=$request->file("logo")->store($dir);
            //opcion1 para almacenar (save)
            $cliente->fill(["logo"=>$path])->save();            
            //opcion2 para almacenar (save)
            //$cliente->logo=$path;
            //$cliente->save();
        }

        //creamos tb un registro en destinatarios con los mismos datos 
        $destinatarios=Destinatario::create($request->only("name","surname","country","province","city","address","postal_code","email","phone","fax","cellphone"));
        return redirect()->route("clientes.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view("clientes.show",compact("cliente"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $paises=Collection::make($this->pais);
        $provincias=$this->provincias;
        return view("clientes.edit",compact("cliente","paises","provincias"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Cliente $cliente)
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
