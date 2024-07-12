<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the Clientis authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected $errorBag = "infoform";
protected   $minpass=8;
protected   $maxpass=16;
protected  $minMobileLength=10;
protected $maxMobileLength=15;
protected $maxlength=500;
protected $alphaexpr='/^[\pL\s\_\-\0-9]+$/u';
protected $alphaAtexpr='/^[\pL\s\_\-\@\.\0-9]+$/u';
    public function rules(): array
    {
       
      
       return[
   
           'name'=>'required|string|unique:clients,name,'.Auth::guard('client')->user()->id.'|regex:'.$this->alphaAtexpr,   
        // 'name'=>'required|alpha_num:ascii|unique:users,name',        
         //'birthdate'=>'required|date',   
         'gender'=>'required|in:male,female',    
         'country'=>'required|not_in:0',   
        'image'=>'nullable|file|image',   
       ];   
    
    }
    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */
public function messages(): array
{  
   return[        
     'name.required'=> __('messages.this field is required',[],'ar') ,  
     'name.unique'=>__('messages.The user_name is already exist',[],'ar'),   
     'name.regex'=>__('messages.must be alpha',[],'en') ,
  
    ];
    
}

}
