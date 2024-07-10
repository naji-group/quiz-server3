<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactEmailRequest extends FormRequest
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
       'contact_email'=>'required|email|string', 
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
     'contact_email.string'=>__('messages.this field is required',[],'en') ,
     'contact_email.required'=>__('messages.this field is required',[],'en') ,
     'contact_email.email'=>__('messages.must be email',[],'en') ,
    ];
    
}
}
