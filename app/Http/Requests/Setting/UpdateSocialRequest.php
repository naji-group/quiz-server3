<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
  
       return[
       'name'=>'required|string',   
       'code'=>'required|string',   
       'link'=>'required|string',  
       
       ];   
    
    }
    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */
public function messages(): array
{
//    $maxlength=500;
//    $minMobileLength=10;
//    $maxMobileLength=15;
   return[
     'name'=>__('messages.this field is required',[],'en') ,
     'code'=>__('messages.this field is required',[],'en') ,
     'link'=>__('messages.this field is required',[],'en') ,
    ];
    
}
}
