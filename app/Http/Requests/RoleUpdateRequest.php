<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Validation\Rule;
class RoleUpdateRequest extends FormRequest
{    
    public function authorize()
    {
        return Auth::check();
    }
 
    public function rules()
    {
        return [
            "name"=>"required|string",
            "slug"=>"required|string",
            "description"=>"required|string",
            "special"=>["nullable",Rule::in(["all-access","no-access"])],
            "permissions"=>"nullable",
            "permissions.*"=>"integer|exists:permissions,id"
        ];
    }
}