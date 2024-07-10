<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
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
       'location'=>'nullable|string',        
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
     'location.string'=>__('messages.this field is required',[],'en') ,
     'desc.string'=>__('messages.this field is required',[],'en') ,
     'meta.string'=>__('messages.this field is required',[],'en') ,
    ];
    
}
}
