<?php

namespace App\Http\Requests\Design;

use Illuminate\Foundation\Http\FormRequest;

class AddHeadSocialRequest extends FormRequest
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
       'setting_id'=>'required|integer|not_in:0',    
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
     'setting_id'=>__('messages.this field is required',[],'en') ,
 
    ];
    
}
}
