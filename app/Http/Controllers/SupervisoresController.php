<?php

namespace App\Http\Controllers;

use App\Supervisor;
use Illuminate\Http\Request;
use App\Http\Requests\SupervisorStoreRequest;
use App\Http\Requests\SupervisorUpdateRequest;
use App\Http\Controllers\HomeController as home;
class SupervisoresController extends Controller
{    
    public function index()
    {
        $supervisor=Supervisor::orderBy("id","DESC")->paginate(10);
        return view("supervisores.index",compact("supervisor"));
    }
 
    public function create()
    {
        return view("supervisores.create");        
    }

    public function store(SupervisorStoreRequest $request)
    {
        $supervisor=Supervisor::create($request->all());
        return redirect()->route("supervisores.index");
    }

    public function show(Supervisor $supervisor)
    {
        return view ("supervisores.show",compact("supervisor"));
    }
    
    public function edit(Supervisor $supervisor)
    {
        return view("supervisores.edit",compact("supervisor"));        
    }
    
    public function update(SupervisorUpdateRequest $request, Supervisor $supervisor)
    {
        $supervisor->update($request->all());
        return redirect()->route("supervisores.edit",$supervisor->id);
    }

    public function destroy(Request $request){
        $div=home::ruta();
        $supervis=Supervisor::where("id",$request->id)->first();
        $supervis->delete();
        $supervisor=Supervisor::paginate(10);
        $supervisor->withPath("");
        $dato=view("supervisores.table_supervisores",compact("supervisor"))->render();
        return response()->json(["dato"=>$dato,"div"=>$div]);
    }
}