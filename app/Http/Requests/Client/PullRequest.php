<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
 
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Web\SettingController;

class PullRequest extends FormRequest
{

    /**
     * Determine if the Clientis authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
 
    public function rules(): array
    {  
      $setctrl=new SettingController();
      $set_arr=$setctrl->getquessetting();
      $minpull= $set_arr['minpoints'];      
       return[           
         'points' => 'required|integer|gt:0|lte:'.auth()->guard('client')->user()->balance.'|gte:'.$minpull,       
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
    'points.required'=> __('messages.this field is required',[],'ar') ,   
   
    ];
    
}

}
