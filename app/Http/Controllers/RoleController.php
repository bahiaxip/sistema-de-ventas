<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{    
    public function index()
    {
        $roles=Role::paginate();
        return view("roles.index",compact("roles"));
    }
 
    public function create()
    {
        $permissions=Permission::get();

        return view("roles.create",compact("permissions"));
    }
    
    public function store(RoleStoreRequest $request)
    {        
        $role=Role::create($request->all());
        $role->permissions()->sync($request->get("permissions"));
        return redirect()->route("roles.edit",$role->id);
    }
    
    public function show(Role $role)
    {
        return view("roles.show",compact("role"));
    }
    
    public function edit(Role $role)
    {
        $permissions=Permission::get();
        return view("roles.edit",compact("role","permissions"));
    }
    
    public function update(RoleUpdateRequest $request, Role $role)
    {
        //actualiza rol
        $role->update($request->all());
        //actualiza permisos
        $role->permissions()->sync($request->get("permissions"));
        return redirect()->route("roles.edit",$role->id);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back();
    }
}