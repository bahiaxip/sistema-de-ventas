<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class CategoryUpdateRequest extends FormRequest
{    
    public function authorize()
    {
        return Auth::check();
    }
 
    public function rules()
    {
        return [
            "name"=>"required|string"
        ];
    }
}