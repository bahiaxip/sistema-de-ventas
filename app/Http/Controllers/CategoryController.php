<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Controllers\HomeController as home;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //anulado método estático
        //$route=home::ruta();
        //dd($route);
        $categories=Category::paginate(10);
        return view("categories.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $category=Category::create($request->all());
        if($request->name)
        {
            $category->name=ucwords($category->name);
            $category->save();    
        }

        return redirect()->route("categories.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {   

        return view("categories.edit",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        if($request->name)
        {
            $category->name=ucwords($category->name);
            $category->save();    
        }
        return redirect()->route("categories.edit",$category->id);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){            
            //método estático que obtiene el nombre del controlador y //añade el prefijo . y el sufijo _table para pasar el nombre //del div que recarga los datos          
            $div=home::ruta();            
            $category=Category::where("id",$request->id)->first();
            $category->delete();
            $categories=Category::paginate(10);
            //withPath permite que al eliminar con ajax no cambie la paginación
            $categories->withPath("");
            $dato=view("categories.table_categories",compact("categories"))->render();
            return response()->json(["dato"=>$dato,"div"=>$div]);
        }
    }
}
