<?php

namespace App\Http\Controllers;

use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController as home;
use Auth;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{    
    public function index()
    {   
        $users=User::paginate(10);
        return view("users.index",compact("users"));
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
        
    public function show(User $user)
    {    
        return view("users.show",compact("user"));
    }
    
    public function edit(User $user)
    {
        $roles=Role::get();
        return view("users.edit",compact("user","roles"));
    }
    
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->get("roles"));
        return redirect()->route("users.edit",$user->id);
    }
    
    public function destroy(Request $request)
    {        
        if($request->ajax()){
            $div=home::ruta();
            $user=User::where("id",$request->id)->first();
            $user->delete();
            $users=User::paginate(10);
            $dato=view("users.table_users",compact("users"))->render();
            return response()->json(["dato"=>$dato,"div"=>$div]);
        }
    }
}