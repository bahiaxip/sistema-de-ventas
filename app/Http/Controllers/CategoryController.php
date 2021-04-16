<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Controllers\HomeController as home;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{    
    public function index()
    { 
        $categories=Category::paginate(10);
        return view("categories.index",compact("categories"));
    }

    public function create()
    {        
        return view("categories.create");
    }

    public function store(CategoryStoreRequest $request)
    {        
        $category=Category::create($request->all());
        if($request->name)
        {
            $category->name=ucwords($category->name);
            $category->save();    
        }

        return redirect()->route("categories.index");
    }

    public function show($id){ }
    
    public function edit(Category $category)
    {   
        return view("categories.edit",compact("category"));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->all());
        if($request->name)
        {
            $category->name=ucwords($category->name);
            $category->save();    
        }
        return redirect()->route("categories.edit",$category->id);        
    }

    public function destroy(Request $request)
    {
        if($request->ajax()){            
            //método estático que obtiene el nombre del controlador y 
            //añade el prefijo . y el sufijo _table para pasar el nombre 
            //del div que recarga los datos          
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